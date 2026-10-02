<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — ADMINISTRATIVE NOMINATION MANAGEMENT
 * Searchable, filterable, paginated dashboard with dossier details and CSV export.
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/categories.php';
require_once __DIR__ . '/../config/mail.php';

$pdo = getDbConnection();
$adminUser = getCurrentAdmin();
$csrfToken = getAdminCsrfToken();

// -----------------------------------------------------------------------------
// 1. Handle Status Update via POST (Option B: Automated Status Emails)
// -----------------------------------------------------------------------------
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status') {
    header('Content-Type: application/json; charset=utf-8');

    $submittedCsrf = (string)($_POST['csrf_token'] ?? '');
    if (!verifyAdminCsrf($submittedCsrf)) {
        http_response_code(403);
        echo json_encode(['success' => false, 'message' => 'Security token invalid.']);
        exit;
    }

    $nomId = (int)($_POST['nomination_id'] ?? 0);
    $newStatus = trim((string)($_POST['status'] ?? ''));

    $validStatuses = ['Pending Review', 'Under Review', 'Shortlisted', 'Approved', 'Rejected'];
    if ($nomId <= 0 || !in_array($newStatus, $validStatuses, true)) {
        http_response_code(400);
        echo json_encode(['success' => false, 'message' => 'Invalid nomination ID or status parameter.']);
        exit;
    }

    try {
        $chkStmt = $pdo->prepare('SELECT * FROM nominations WHERE id = :id');
        $chkStmt->execute(['id' => $nomId]);
        $nomination = $chkStmt->fetch();

        if (!$nomination) {
            http_response_code(404);
            echo json_encode(['success' => false, 'message' => 'Nomination record not found.']);
            exit;
        }

        $currentStatus = (string)$nomination['status'];

        // Avoid duplicate notification if status is unchanged
        if ($currentStatus === $newStatus) {
            echo json_encode([
                'success' => true,
                'message' => "Nomination status is already {$newStatus}. No change made.",
                'status' => $newStatus,
                'email_sent' => false
            ]);
            exit;
        }

        // Update status in database
        $upStmt = $pdo->prepare('UPDATE nominations SET status = :status, updated_at = NOW() WHERE id = :id');
        $upStmt->execute(['status' => $newStatus, 'id' => $nomId]);

        // Option B: Automatically send status update email to registered nominator
        $mailResult = sendStatusUpdateNotification($nomination, $currentStatus, $newStatus);

        echo json_encode([
            'success' => true,
            'message' => "Nomination status updated to {$newStatus}.",
            'status' => $newStatus,
            'email_sent' => (bool)($mailResult['sent'] ?? false),
            'email_info' => (string)($mailResult['message'] ?? $mailResult['reason'] ?? '')
        ]);
        exit;
    } catch (Exception $e) {
        error_log('[ADMIN STATUS UPDATE ERROR] ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'Failed to update nomination status.']);
        exit;
    }
}

// -----------------------------------------------------------------------------
// 2. Compute Dashboard Statistics
// -----------------------------------------------------------------------------
$stats = [
    'total'       => 0,
    'individual'  => 0,
    'corporate'   => 0,
    'pending'     => 0,
    'under_review'=> 0,
    'approved'    => 0,
];

try {
    $statQuery = $pdo->query('
        SELECT
            COUNT(*) AS total,
            SUM(CASE WHEN nominee_type = "individual" THEN 1 ELSE 0 END) AS individual,
            SUM(CASE WHEN nominee_type = "corporate" THEN 1 ELSE 0 END) AS corporate,
            SUM(CASE WHEN status = "Pending Review" THEN 1 ELSE 0 END) AS pending,
            SUM(CASE WHEN status = "Under Review" THEN 1 ELSE 0 END) AS under_review,
            SUM(CASE WHEN status IN ("Shortlisted", "Approved") THEN 1 ELSE 0 END) AS approved
        FROM nominations
    ');
    if ($row = $statQuery->fetch()) {
        $stats['total']        = (int)($row['total'] ?? 0);
        $stats['individual']   = (int)($row['individual'] ?? 0);
        $stats['corporate']    = (int)($row['corporate'] ?? 0);
        $stats['pending']      = (int)($row['pending'] ?? 0);
        $stats['under_review'] = (int)($row['under_review'] ?? 0);
        $stats['approved']     = (int)($row['approved'] ?? 0);
    }
} catch (Exception $e) {
    error_log('[ADMIN STATS ERROR] ' . $e->getMessage());
}

// -----------------------------------------------------------------------------
// 3. Search, Filter, and Pagination Parameters
// -----------------------------------------------------------------------------
$search   = trim((string)($_GET['search'] ?? ''));
$stream   = trim((string)($_GET['stream'] ?? ''));
$category = trim((string)($_GET['category'] ?? ''));
$status   = trim((string)($_GET['status'] ?? ''));
$page     = max(1, (int)($_GET['page'] ?? 1));
$perPage  = 15;
$offset   = ($page - 1) * $perPage;

$where = ['1=1'];
$params = [];

if ($search !== '') {
    $where[] = '(tracking_reference LIKE :s OR nominee_name LIKE :s OR company_name LIKE :s OR nominator_email LIKE :s)';
    $params['s'] = '%' . $search . '%';
}

if ($stream !== '' && in_array($stream, ['individual', 'corporate'], true)) {
    $where[] = 'nominee_type = :stream';
    $params['stream'] = $stream;
}

if ($category !== '') {
    $where[] = 'category = :cat';
    $params['cat'] = $category;
}

if ($status !== '') {
    $where[] = 'status = :status';
    $params['status'] = $status;
}

$whereClause = implode(' AND ', $where);

// Count total filtered records
$countStmt = $pdo->prepare("SELECT COUNT(*) FROM nominations WHERE {$whereClause}");
$countStmt->execute($params);
$totalRecords = (int)$countStmt->fetchColumn();
$totalPages = max(1, (int)ceil($totalRecords / $perPage));

// Fetch page records
$dataSql = "SELECT * FROM nominations WHERE {$whereClause} ORDER BY created_at DESC LIMIT {$perPage} OFFSET {$offset}";
$dataStmt = $pdo->prepare($dataSql);
$dataStmt->execute($params);
$nominations = $dataStmt->fetchAll();

// Build query string for export and pagination
$filterQueryArgs = array_filter([
    'search'   => $search,
    'stream'   => $stream,
    'category' => $category,
    'status'   => $status,
]);
$exportQueryString = http_build_query($filterQueryArgs);

// All official categories for filter dropdown
$allCategories = array_merge(getIndividualCategories(), getCorporateCategories());

// -----------------------------------------------------------------------------
// 4. Handle Dedicated A4 Print Actions (Protected by Existing Admin Auth)
// -----------------------------------------------------------------------------
$printAction = trim((string)($_GET['print'] ?? ''));
if ($printAction === 'register') {
    // Fetch ALL records matching filters for the printable register (no pagination limit)
    $printSql = "SELECT * FROM nominations WHERE {$whereClause} ORDER BY created_at DESC";
    $printStmt = $pdo->prepare($printSql);
    $printStmt->execute($params);
    $printNominations = $printStmt->fetchAll(PDO::FETCH_ASSOC);

    renderA4PrintRegister($printNominations, $adminUser, $filterQueryArgs);
    exit;
} elseif ($printAction === 'dossier') {
    $nomId = (int)($_GET['id'] ?? 0);
    $dosStmt = $pdo->prepare('SELECT * FROM nominations WHERE id = :id');
    $dosStmt->execute(['id' => $nomId]);
    $dossier = $dosStmt->fetch(PDO::FETCH_ASSOC);

    if (!$dossier) {
        http_response_code(404);
        exit('Nomination record not found.');
    }

    renderA4PrintDossier($dossier, $adminUser);
    exit;
}

/**
 * Generates official A4 Landscape Nomination Register for print & PDF export.
 */
function renderA4PrintRegister(array $nominations, ?array $adminUser, array $filterQueryArgs): void {
    $totalCount = count($nominations);
    $generatedDate = date('d M Y, h:i A');

    $activeFilters = [];
    if (!empty($filterQueryArgs['search'])) {
        $activeFilters[] = 'Search: "' . htmlspecialchars($filterQueryArgs['search']) . '"';
    }
    if (!empty($filterQueryArgs['stream'])) {
        $activeFilters[] = 'Stream: ' . ucfirst(htmlspecialchars($filterQueryArgs['stream']));
    }
    if (!empty($filterQueryArgs['category'])) {
        $activeFilters[] = 'Category: ' . htmlspecialchars($filterQueryArgs['category']);
    }
    if (!empty($filterQueryArgs['status'])) {
        $activeFilters[] = 'Status: ' . htmlspecialchars($filterQueryArgs['status']);
    }
    $filterSummary = !empty($activeFilters) ? implode(' | ', $activeFilters) : 'All Records (Unfiltered)';
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>INTECARE 2026 — Nomination Register (A4 Landscape)</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
  <style>
    @page {
      size: A4 landscape;
      margin: 10mm 12mm 12mm 12mm;
    }
    * {
      box-sizing: border-box;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      color: #111827;
      background: #F3F4F6;
      font-size: 8.5pt;
      line-height: 1.35;
    }

    @media screen {
      .print-toolbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #062E25;
        color: #FFFFFF;
        padding: 10px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 14px rgba(0,0,0,0.18);
        border-bottom: 1px solid rgba(197, 160, 89, 0.3);
      }
      .toolbar-brand {
        font-weight: 800;
        font-size: 13px;
        letter-spacing: 0.04em;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .toolbar-tag {
        background: rgba(197, 160, 89, 0.15);
        color: #C5A059;
        border: 1px solid rgba(197, 160, 89, 0.4);
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 800;
      }
      .toolbar-actions {
        display: flex;
        gap: 10px;
        align-items: center;
      }
      .btn-print {
        background: #C5A059;
        color: #021C16;
        border: none;
        padding: 7px 16px;
        border-radius: 6px;
        font-weight: 800;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: transform 0.15s ease;
      }
      .btn-print:hover {
        transform: translateY(-1px);
        background: #D4AF37;
      }
      .btn-back {
        background: rgba(255,255,255,0.12);
        color: #FFFFFF;
        border: 1px solid rgba(255,255,255,0.25);
        padding: 7px 14px;
        border-radius: 6px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
      }
      .btn-back:hover {
        background: rgba(255,255,255,0.22);
      }
      .print-wrapper {
        max-width: 1100px;
        margin: 20px auto 40px;
        background: #FFFFFF;
        padding: 24px 30px;
        border-radius: 8px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
      }
    }

    @media print {
      body {
        background: #FFFFFF !important;
        color: #000000 !important;
        padding: 0 !important;
      }
      .print-toolbar {
        display: none !important;
      }
      .print-wrapper {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border-radius: 0 !important;
      }
    }

    /* Print Header */
    .register-header {
      border-bottom: 2px solid #087F8C;
      padding-bottom: 10px;
      margin-bottom: 12px;
      display: flex;
      justify-content: space-between;
      align-items: flex-end;
    }
    .register-header-left h1 {
      margin: 0;
      font-size: 15pt;
      font-weight: 800;
      color: #031E28;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }
    .register-header-left h2 {
      margin: 2px 0 0;
      font-size: 10pt;
      font-weight: 700;
      color: #087F8C;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .register-header-right {
      text-align: right;
      font-size: 8pt;
      color: #374151;
      line-height: 1.45;
    }
    .register-filter-line {
      font-size: 7.2pt;
      color: #6B7280;
      margin-top: 3px;
    }

    /* Print Table */
    table.register-table {
      width: 100%;
      border-collapse: collapse;
      table-layout: fixed;
      font-size: 8pt;
    }
    thead {
      display: table-header-group;
    }
    tr {
      break-inside: avoid;
      page-break-inside: avoid;
    }
    th {
      background: #031E28;
      color: #FFFFFF;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-size: 7pt;
      padding: 6px 7px;
      border: 1px solid #031E28;
      text-align: left;
      vertical-align: middle;
    }
    td {
      padding: 6px 7px;
      border: 1px solid #D1D5DB;
      vertical-align: top;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }
    tr:nth-child(even) td {
      background: #F9FAFB;
    }

    /* Columns Widths (100% exact total) */
    .col-no { width: 3.5%; text-align: center; font-weight: 600; }
    .col-ref { width: 12%; font-family: 'Space Grotesk', monospace; font-weight: 700; color: #031E28; }
    .col-stream { width: 8.5%; text-transform: uppercase; font-size: 7pt; font-weight: 700; }
    .col-cat { width: 25%; font-weight: 600; line-height: 1.3; }
    .col-nom { width: 17%; line-height: 1.3; }
    .col-nom-title { font-weight: 700; color: #111827; }
    .col-desig { width: 16%; color: #4B5563; font-size: 7.5pt; line-height: 1.3; }
    .col-status { width: 9%; }
    .col-date { width: 9%; font-size: 7.2pt; color: #374151; white-space: nowrap; }

    /* High contrast status badge for B&W printing */
    .status-badge-print {
      display: inline-block;
      padding: 2px 5px;
      border: 1px solid #374151;
      border-radius: 3px;
      font-size: 6.8pt;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      color: #111827;
      background: #F3F4F6;
      white-space: nowrap;
    }

    /* Print Footer */
    .register-footer {
      margin-top: 14px;
      padding-top: 8px;
      border-top: 1px solid #9CA3AF;
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-size: 7pt;
      color: #4B5563;
    }
  </style>
</head>
<body>
  <!-- Non-printing Interactive Control Toolbar -->
  <div class="print-toolbar">
    <div class="toolbar-brand">
      <span>INTECARE EXCELLENCE AWARD 2026</span>
      <span class="toolbar-tag">A4 LANDSCAPE REGISTER</span>
    </div>
    <div class="toolbar-actions">
      <span style="font-size: 11px; color: #A3C2CB;">Total: <?= $totalCount ?> records</span>
      <button type="button" class="btn-print" onclick="window.print()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
        <span>Print Register</span>
      </button>
      <a href="nominations.php" class="btn-back">&larr; Back to Dashboard</a>
    </div>
  </div>

  <div class="print-wrapper">
    <!-- Professional INTECARE Header -->
    <header class="register-header">
      <div class="register-header-left">
        <h1>INTECARE EXCELLENCE AWARD 2026</h1>
        <h2>NOMINATION REGISTER</h2>
      </div>
      <div class="register-header-right">
        <div><strong>Generated:</strong> <?= $generatedDate ?></div>
        <div><strong>Total Nominations:</strong> <?= number_format($totalCount) ?></div>
        <div class="register-filter-line"><strong>Scope:</strong> <?= $filterSummary ?></div>
      </div>
    </header>

    <!-- Register Table -->
    <table class="register-table">
      <thead>
        <tr>
          <th class="col-no">No.</th>
          <th class="col-ref">Tracking Ref</th>
          <th class="col-stream">Stream</th>
          <th class="col-cat">Award Category</th>
          <th class="col-nom">Nominee</th>
          <th class="col-desig">Designation / Organisation</th>
          <th class="col-status">Status</th>
          <th class="col-date">Date Submitted</th>
        </tr>
      </thead>
      <tbody>
        <?php if (empty($nominations)): ?>
          <tr>
            <td colspan="8" style="text-align: center; padding: 30px; color: #6B7280;">
              No nomination records match the current filter criteria.
            </td>
          </tr>
        <?php else: ?>
          <?php foreach ($nominations as $idx => $nom): ?>
            <?php
              $nomineePrimary = $nom['nominee_type'] === 'individual'
                ? ($nom['nominee_name'] ?: '—')
                : ($nom['company_name'] ?: '—');
              $nomineeSecondary = $nom['nominee_type'] === 'individual'
                ? ($nom['nominee_designation'] ?: ($nom['company_name'] ?: '—'))
                : ($nom['company_reg'] ?: '—');
            ?>
            <tr>
              <td class="col-no"><?= $idx + 1 ?></td>
              <td class="col-ref"><?= htmlspecialchars($nom['tracking_reference']) ?></td>
              <td class="col-stream"><?= htmlspecialchars(ucfirst($nom['nominee_type'])) ?></td>
              <td class="col-cat"><?= htmlspecialchars($nom['category']) ?></td>
              <td class="col-nom">
                <div class="col-nom-title"><?= htmlspecialchars($nomineePrimary) ?></div>
              </td>
              <td class="col-desig"><?= htmlspecialchars($nomineeSecondary) ?></td>
              <td class="col-status">
                <span class="status-badge-print"><?= htmlspecialchars($nom['status']) ?></span>
              </td>
              <td class="col-date">
                <?= htmlspecialchars(date('d M Y', strtotime($nom['created_at']))) ?><br>
                <span style="color: #6B7280; font-size: 6.8pt;"><?= htmlspecialchars(date('h:i A', strtotime($nom['created_at']))) ?></span>
              </td>
            </tr>
          <?php endforeach; ?>
        <?php endif; ?>
      </tbody>
    </table>

    <!-- Print Footer -->
    <footer class="register-footer">
      <div>INTECARE Excellence Award 2026 &bull; Secretariat</div>
      <div>Confidential Administrative Record &bull; Prepared by <?= htmlspecialchars($adminUser['username'] ?? 'Admin') ?></div>
    </footer>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      // Auto trigger print dialogue after rendering
      setTimeout(() => { window.print(); }, 350);
    });
  </script>
</body>
</html>
    <?php
}

/**
 * Generates official A4 Portrait Nomination Dossier for print & PDF export.
 */
function renderA4PrintDossier(array $nom, ?array $adminUser): void {
    $nomineePrimary = $nom['nominee_type'] === 'individual'
        ? ($nom['nominee_name'] ?: '—')
        : ($nom['company_name'] ?: '—');
    $nomineeSecondary = $nom['nominee_type'] === 'individual'
        ? ($nom['nominee_designation'] ?: '—')
        : ($nom['company_reg'] ?: '—');
    $wordCount = count(preg_split('/\s+/', trim((string)$nom['rationale']), -1, PREG_SPLIT_NO_EMPTY));
    $generatedDate = date('d M Y, h:i A');
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dossier <?= htmlspecialchars($nom['tracking_reference']) ?> — INTECARE 2026</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
  <style>
    @page {
      size: A4 portrait;
      margin: 12mm 16mm 16mm 16mm;
    }
    * {
      box-sizing: border-box;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    body {
      margin: 0;
      padding: 0;
      font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
      color: #111827;
      background: #F3F4F6;
      font-size: 9pt;
      line-height: 1.45;
    }

    @media screen {
      .print-toolbar {
        position: sticky;
        top: 0;
        z-index: 1000;
        background: #062E25;
        color: #FFFFFF;
        padding: 10px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        box-shadow: 0 4px 14px rgba(0,0,0,0.18);
        border-bottom: 1px solid rgba(197, 160, 89, 0.3);
      }
      .toolbar-brand {
        font-weight: 800;
        font-size: 13px;
        display: flex;
        align-items: center;
        gap: 10px;
      }
      .toolbar-tag {
        background: rgba(197, 160, 89, 0.15);
        color: #C5A059;
        border: 1px solid rgba(197, 160, 89, 0.4);
        padding: 2px 7px;
        border-radius: 4px;
        font-size: 10px;
        font-weight: 800;
      }
      .toolbar-actions {
        display: flex;
        gap: 10px;
        align-items: center;
      }
      .btn-print {
        background: #C5A059;
        color: #021C16;
        border: none;
        padding: 7px 16px;
        border-radius: 6px;
        font-weight: 800;
        font-size: 12px;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
      }
      .btn-print:hover {
        background: #D4F754;
      }
      .btn-back {
        background: rgba(255,255,255,0.12);
        color: #FFFFFF;
        border: 1px solid rgba(255,255,255,0.25);
        padding: 7px 14px;
        border-radius: 6px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
      }
      .btn-back:hover {
        background: rgba(255,255,255,0.22);
      }
      .print-wrapper {
        max-width: 820px;
        margin: 20px auto 40px;
        background: #FFFFFF;
        padding: 32px 38px;
        border-radius: 8px;
        box-shadow: 0 4px 24px rgba(0,0,0,0.07);
      }
    }

    @media print {
      body {
        background: #FFFFFF !important;
        color: #000000 !important;
        padding: 0 !important;
      }
      .print-toolbar {
        display: none !important;
      }
      .print-wrapper {
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border-radius: 0 !important;
      }
    }

    /* Official Dossier Header */
    .dossier-header {
      border-bottom: 2px solid #031E28;
      padding-bottom: 12px;
      margin-bottom: 18px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
    }
    .dossier-title-block h1 {
      margin: 0;
      font-size: 16pt;
      font-weight: 800;
      color: #031E28;
      letter-spacing: 0.04em;
      text-transform: uppercase;
    }
    .dossier-title-block h2 {
      margin: 3px 0 0;
      font-size: 11pt;
      font-weight: 700;
      color: #087F8C;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .dossier-header-meta {
      text-align: right;
      font-size: 8pt;
      color: #4B5563;
      line-height: 1.45;
    }
    .dossier-ref-tag {
      font-family: 'Space Grotesk', monospace;
      font-size: 11pt;
      font-weight: 700;
      color: #031E28;
      margin-top: 2px;
    }

    /* Core Specifications Grid */
    .dossier-specs-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      border: 1px solid #D1D5DB;
    }
    .dossier-specs-table th {
      width: 30%;
      background: #F3F4F6;
      color: #374151;
      font-size: 7.8pt;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      padding: 7px 10px;
      border: 1px solid #D1D5DB;
      text-align: left;
      vertical-align: top;
    }
    .dossier-specs-table td {
      width: 70%;
      padding: 7px 10px;
      border: 1px solid #D1D5DB;
      font-size: 8.8pt;
      vertical-align: top;
      color: #111827;
    }

    /* Status Badge */
    .status-print-badge {
      display: inline-block;
      padding: 2px 7px;
      border: 1px solid #111827;
      border-radius: 4px;
      font-size: 7.5pt;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      color: #111827;
      background: #E5E7EB;
    }

    /* Rationale Block */
    .dossier-section-block {
      margin-bottom: 20px;
      page-break-inside: auto;
    }
    .dossier-section-title {
      font-size: 9.5pt;
      font-weight: 800;
      color: #031E28;
      text-transform: uppercase;
      letter-spacing: 0.06em;
      border-bottom: 1.5px solid #087F8C;
      padding-bottom: 4px;
      margin-bottom: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    .dossier-rationale-box {
      border: 1px solid #D1D5DB;
      background: #FAFAFA;
      padding: 14px 16px;
      border-radius: 4px;
      font-size: 9pt;
      line-height: 1.6;
      color: #1F2937;
      white-space: pre-wrap;
      word-wrap: break-word;
      overflow-wrap: break-word;
    }

    /* Audit & Technical Verification */
    .dossier-audit-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 8px 16px;
      border: 1px solid #E5E7EB;
      background: #F9FAFB;
      padding: 10px 14px;
      border-radius: 4px;
      font-size: 7.6pt;
      color: #4B5563;
      margin-bottom: 20px;
      page-break-inside: avoid;
    }

    /* Secretariat Evaluation & Sign-off Panel */
    .dossier-eval-panel {
      border: 1.5px solid #031E28;
      border-radius: 4px;
      padding: 14px 16px;
      margin-bottom: 20px;
      page-break-inside: avoid;
    }
    .dossier-eval-title {
      font-size: 8.8pt;
      font-weight: 800;
      text-transform: uppercase;
      letter-spacing: 0.08em;
      color: #031E28;
      margin-bottom: 10px;
      border-bottom: 1px solid #D1D5DB;
      padding-bottom: 4px;
    }
    .eval-row {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 12px;
      font-size: 8.2pt;
    }
    .eval-checkboxes {
      display: flex;
      gap: 16px;
      font-size: 8.2pt;
      font-weight: 600;
      color: #111827;
    }
    .eval-sign-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 24px;
      margin-top: 14px;
      padding-top: 10px;
    }
    .eval-sign-line {
      border-top: 1px solid #6B7280;
      padding-top: 4px;
      font-size: 7.5pt;
      color: #4B5563;
    }

    /* Footer */
    .dossier-footer {
      border-top: 1px solid #D1D5DB;
      padding-top: 8px;
      display: flex;
      justify-content: space-between;
      font-size: 7.2pt;
      color: #6B7280;
    }
  </style>
</head>
<body>
  <div class="print-toolbar">
    <div class="toolbar-brand">
      <span>INTECARE EXCELLENCE AWARD 2026</span>
      <span class="toolbar-tag">A4 PORTRAIT DOSSIER</span>
    </div>
    <div class="toolbar-actions">
      <span style="font-size: 11px; color: #A3C2CB;">Ref: <?= htmlspecialchars($nom['tracking_reference']) ?></span>
      <button type="button" class="btn-print" onclick="window.print()">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
        <span>Print Dossier</span>
      </button>
      <a href="nominations.php" class="btn-back">&larr; Back to Dashboard</a>
    </div>
  </div>

  <div class="print-wrapper">
    <!-- Header -->
    <header class="dossier-header">
      <div class="dossier-title-block">
        <h1>INTECARE EXCELLENCE AWARD 2026</h1>
        <h2>NOMINATION DOSSIER</h2>
      </div>
      <div class="dossier-header-meta">
        <div>Official Record &bull; Strictly Confidential</div>
        <div class="dossier-ref-tag"><?= htmlspecialchars($nom['tracking_reference']) ?></div>
      </div>
    </header>

    <!-- Specs Table -->
    <table class="dossier-specs-table">
      <tbody>
        <tr>
          <th>Tracking Reference</th>
          <td><strong style="font-family: 'Space Grotesk', monospace; font-size: 9.5pt;"><?= htmlspecialchars($nom['tracking_reference']) ?></strong></td>
        </tr>
        <tr>
          <th>Status</th>
          <td><span class="status-print-badge"><?= htmlspecialchars($nom['status']) ?></span></td>
        </tr>
        <tr>
          <th>Nomination Stream</th>
          <td><?= htmlspecialchars(ucfirst($nom['nominee_type'])) ?> Excellence Award</td>
        </tr>
        <tr>
          <th>Award Category</th>
          <td><strong><?= htmlspecialchars($nom['category']) ?></strong></td>
        </tr>
        <tr>
          <th>Nominee / Organisation</th>
          <td><strong><?= htmlspecialchars($nomineePrimary) ?></strong></td>
        </tr>
        <tr>
          <th>Designation</th>
          <td><?= htmlspecialchars($nomineeSecondary) ?></td>
        </tr>
        <tr>
          <th>Nominator</th>
          <td><?= htmlspecialchars($nom['nominator_email']) ?></td>
        </tr>
        <tr>
          <th>Registered Work Email</th>
          <td><?= htmlspecialchars($nom['nominator_email']) ?></td>
        </tr>
        <tr>
          <th>Contact Telephone</th>
          <td><?= htmlspecialchars($nom['nominator_phone'] ?: 'N/A') ?></td>
        </tr>
        <tr>
          <th>Submission Date</th>
          <td><?= htmlspecialchars(date('l, d F Y — h:i:s A', strtotime($nom['created_at']))) ?></td>
        </tr>
      </tbody>
    </table>

    <!-- Executive Summary / Rationale -->
    <section class="dossier-section-block">
      <div class="dossier-section-title">
        <span>Executive Summary of Achievements / Nomination Rationale</span>
        <span style="font-size: 7.5pt; font-weight: 600; color: #4B5563; text-transform: none;"><?= $wordCount ?> words (Max 300)</span>
      </div>
      <div class="dossier-rationale-box"><?= nl2br(htmlspecialchars($nom['rationale'])) ?></div>
    </section>

    <!-- Technical Audit Trail -->
    <section class="dossier-audit-grid">
      <div><strong>Record ID:</strong> #<?= (int)$nom['id'] ?></div>
      <div><strong>Submission IP:</strong> <?= htmlspecialchars($nom['ip_address'] ?: 'Logged') ?></div>
      <div><strong>Confirmation Email:</strong> <?= htmlspecialchars($nom['email_sent_at'] ?: 'N/A') ?></div>
      <div><strong>Last Status Update:</strong> <?= htmlspecialchars($nom['updated_at'] ?: $nom['created_at']) ?></div>
    </section>

    <!-- Secretariat & Evaluation Committee Endorsement Box -->
    <section class="dossier-eval-panel">
      <div class="dossier-eval-title">Secretariat &amp; Jury Evaluation Endorsement</div>
      <div class="eval-row">
        <span><strong>Evaluation Verdict:</strong></span>
        <div class="eval-checkboxes">
          <span>[&nbsp;&nbsp;] Approved</span>
          <span>[&nbsp;&nbsp;] Shortlisted</span>
          <span>[&nbsp;&nbsp;] Under Review</span>
          <span>[&nbsp;&nbsp;] Rejected</span>
        </div>
      </div>
      <div class="eval-sign-grid">
        <div>
          <div style="height: 32px;"></div>
          <div class="eval-sign-line">Evaluation Committee Member Signature &bull; Date</div>
        </div>
        <div>
          <div style="height: 32px;"></div>
          <div class="eval-sign-line">Secretariat Verification Officer &bull; Official Stamp</div>
        </div>
      </div>
    </section>

    <!-- Footer -->
    <footer class="dossier-footer">
      <div>INTECARE Excellence Award 2026 &bull; Secretariat</div>
      <div>Printed by <?= htmlspecialchars($adminUser['username'] ?? 'Admin') ?> &bull; <?= $generatedDate ?></div>
    </footer>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      setTimeout(() => { window.print(); }, 350);
    });
  </script>
</body>
</html>
    <?php
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Nomination Dossier Registry — INTECARE 2026 Admin</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    :root {
      --bg-dark: #021C16;
      --card-dark: #062E25;
      --card-border: rgba(197, 160, 89, 0.35);
      --accent-lime: #C5A059;
      --text-muted: #8EAAB3;
    }
    html, body {
      max-width: 100%;
      overflow-x: hidden;
    }
    body {
      background-color: var(--bg-dark);
      color: #FFFFFF;
      font-family: var(--font-body);
      min-height: 100vh;
      margin: 0;
      padding: 0;
    }
    /* Top Header Bar */
    .admin-nav-bar {
      background: var(--card-dark);
      border-bottom: 1px solid rgba(8, 127, 140, 0.35);
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      position: sticky;
      top: 0;
      z-index: 100;
    }
    .admin-logo-area {
      display: flex;
      align-items: center;
      gap: 1rem;
    }
    .admin-title-badge {
      font-family: var(--font-heading);
      font-size: 1.0625rem;
      font-weight: 800;
      color: #FFFFFF;
      letter-spacing: 0.04em;
    }
    .admin-role-pill {
      background: rgba(198, 242, 77, 0.15);
      border: 1px solid rgba(198, 242, 77, 0.4);
      color: var(--accent-lime);
      padding: 0.25rem 0.7rem;
      border-radius: 999px;
      font-size: 0.8125rem;
      font-weight: 800;
      letter-spacing: 0.08em;
      text-transform: uppercase;
    }
    .admin-user-menu {
      display: flex;
      align-items: center;
      gap: 1.25rem;
      font-size: 0.9375rem;
    }
    .admin-user-name {
      color: #D5E5E9;
      font-weight: 600;
    }
    .btn-logout {
      background: rgba(220, 38, 38, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.35);
      color: #FCA5A5;
      padding: 0.45rem 0.95rem;
      border-radius: 6px;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.84rem;
      transition: background 0.2s;
    }
    .btn-logout:hover {
      background: rgba(220, 38, 38, 0.3);
      color: #FFFFFF;
    }
    /* Main Layout */
    .admin-container {
      max-width: 1400px;
      margin: 0 auto;
      padding: 2rem 1.5rem;
    }
    /* Stats Row */
    .stats-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 1rem;
      margin-bottom: 2rem;
    }
    .stat-card {
      background: var(--card-dark);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 1.25rem;
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.25);
    }
    .stat-card-title {
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: #A3C2CB;
      margin-bottom: 0.5rem;
    }
    .stat-card-value {
      font-family: var(--font-heading);
      font-size: 1.85rem;
      font-weight: 800;
      color: #FFFFFF;
      line-height: 1;
    }
    .stat-card-value.lime {
      color: var(--accent-lime);
    }
    /* Filter Bar */
    .filter-panel {
      background: var(--card-dark);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 1.5rem;
      margin-bottom: 2rem;
    }
    .filter-form {
      display: grid;
      grid-template-columns: 2fr 1fr 1.5fr 1fr auto;
      gap: 1rem;
      align-items: flex-end;
    }
    @media (max-width: 1024px) {
      .filter-form {
        grid-template-columns: 1fr 1fr;
      }
    }
    @media (max-width: 640px) {
      .filter-form {
        grid-template-columns: 1fr;
      }
    }
    .filter-group label {
      display: block;
      font-size: 0.8125rem;
      font-weight: 700;
      letter-spacing: 0.06em;
      color: #B5D4DC;
      text-transform: uppercase;
      margin-bottom: 0.4rem;
    }
    .filter-control {
      width: 100%;
      background: #02141B;
      border: 1px solid rgba(255, 255, 255, 0.15);
      color: #FFFFFF;
      border-radius: 6px;
      padding: 0.7rem 0.85rem;
      font-size: 0.9375rem;
      font-family: var(--font-body);
    }
    .filter-control:focus {
      outline: none;
      border-color: var(--accent-lime);
    }
    .filter-actions {
      display: flex;
      gap: 0.5rem;
    }
    .btn-filter {
      background: #087F8C;
      color: #FFFFFF;
      font-weight: 700;
      font-size: 0.875rem;
      border: none;
      border-radius: 6px;
      padding: 0.7rem 1.15rem;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
    }
    .btn-filter:hover {
      background: #0BA3B4;
    }
    .btn-reset {
      background: rgba(255, 255, 255, 0.08);
      color: #D5E5E9;
      font-weight: 700;
      font-size: 0.875rem;
      border: 1px solid rgba(255, 255, 255, 0.18);
      border-radius: 6px;
      padding: 0.7rem 1rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
    }
    .btn-export {
      background: rgba(198, 242, 77, 0.15);
      border: 1px solid rgba(198, 242, 77, 0.4);
      color: var(--accent-lime);
      font-weight: 800;
      font-size: 0.875rem;
      border-radius: 6px;
      padding: 0.7rem 1.15rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      white-space: nowrap;
      transition: all 0.2s ease;
    }
    .btn-export:hover {
      background: var(--accent-lime);
      color: #031E28;
    }
    .btn-print-register {
      background: rgba(8, 127, 140, 0.2);
      border: 1px solid rgba(8, 127, 140, 0.5);
      color: #77D9C8;
      font-weight: 800;
      font-size: 0.875rem;
      border-radius: 6px;
      padding: 0.7rem 1.15rem;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.45rem;
      white-space: nowrap;
      transition: all 0.2s ease;
    }
    .btn-print-register:hover {
      background: #087F8C;
      color: #FFFFFF;
      border-color: #087F8C;
    }
    /* Table Styling - Responsive Without Horizontal Scrolling */
    .table-container {
      background: var(--card-dark);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      width: 100%;
      overflow: hidden; /* STRICT: No horizontal scroll container */
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }
    .nominations-table {
      width: 100%;
      max-width: 100%;
      table-layout: fixed;
      border-collapse: collapse;
      text-align: left;
      font-size: 0.9375rem;
    }
    .col-ref { width: 12%; }
    .col-stream { width: 8.5%; }
    .col-nominee { width: 16%; }
    .col-category { width: 21%; }
    .col-nominator { width: 14.5%; }
    .col-status { width: 11%; }
    .col-date { width: 7%; }
    .col-action { width: 10%; }

    .nominations-table th {
      background: #011016;
      color: #C2DFE7;
      font-size: 0.8125rem;
      font-weight: 800;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      padding: 0.85rem 0.6rem;
      border-bottom: 1px solid rgba(8, 127, 140, 0.3);
      vertical-align: middle;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
    .nominations-table td {
      padding: 0.85rem 0.6rem;
      border-bottom: 1px solid rgba(255, 255, 255, 0.06);
      vertical-align: middle;
      overflow-wrap: anywhere;
      word-break: normal;
    }
    .nominations-table tr:hover {
      background: rgba(8, 127, 140, 0.07);
    }
    .ref-badge {
      font-family: monospace;
      font-size: 0.875rem;
      font-weight: 800;
      color: var(--accent-lime);
      background: rgba(198, 242, 77, 0.1);
      border: 1px solid rgba(198, 242, 77, 0.3);
      padding: 0.25rem 0.45rem;
      border-radius: 4px;
      display: inline-block;
      max-width: 100%;
      word-break: break-all;
    }
    .stream-pill {
      display: inline-block;
      font-size: 0.78rem;
      font-weight: 800;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      padding: 0.25rem 0.5rem;
      border-radius: 999px;
      text-align: center;
      white-space: nowrap;
    }
    .stream-pill.individual {
      background: rgba(8, 127, 140, 0.2);
      border: 1px solid #087F8C;
      color: #77D9C8;
    }
    .stream-pill.corporate {
      background: rgba(198, 242, 77, 0.15);
      border: 1px solid var(--accent-lime);
      color: var(--accent-lime);
    }
    .nominee-primary {
      font-weight: 700;
      color: #FFFFFF;
      line-height: 1.35;
      overflow-wrap: anywhere;
    }
    .nominee-secondary {
      color: #B2CDD4;
      font-size: 0.84rem;
      line-height: 1.35;
      margin-top: 2px;
      overflow-wrap: anywhere;
    }
    .category-name {
      font-weight: 600;
      color: #D5E5E9;
      line-height: 1.4;
      display: block;
      overflow-wrap: break-word;
    }
    .nominator-email {
      color: #77D9C8;
      text-decoration: none;
      font-size: 0.875rem;
      word-break: break-all;
      overflow-wrap: anywhere;
      display: block;
      line-height: 1.35;
      transition: color 0.2s;
    }
    .nominator-email:hover {
      color: var(--accent-lime);
      text-decoration: underline;
    }
    .nominator-phone {
      color: #B2CDD4;
      font-size: 0.8125rem;
      margin-top: 2px;
      word-break: break-all;
    }
    .status-select {
      background: #02141B;
      color: #FFFFFF;
      border: 1px solid rgba(255, 255, 255, 0.2);
      border-radius: 4px;
      padding: 0.38rem 0.4rem;
      font-size: 0.84rem;
      font-weight: 700;
      cursor: pointer;
      width: 100%;
      max-width: 100%;
      box-sizing: border-box;
      text-overflow: ellipsis;
      transition: border-color 0.2s;
    }
    .status-select.pending { color: #F59E0B; border-color: rgba(245, 158, 11, 0.4); }
    .status-select.under_review { color: #38BDF8; border-color: rgba(56, 189, 248, 0.4); }
    .status-select.shortlisted { color: var(--accent-lime); border-color: rgba(198, 242, 77, 0.4); }
    .status-select.approved { color: #4ADE80; border-color: rgba(74, 222, 128, 0.4); }
    .status-select.rejected { color: #F87171; border-color: rgba(248, 113, 113, 0.4); }

    .date-calendar {
      display: block;
      font-size: 0.84rem;
      color: #D5E5E9;
      line-height: 1.25;
      white-space: nowrap;
    }
    .date-clock {
      display: block;
      font-size: 0.7rem;
      color: var(--text-muted);
      line-height: 1.2;
      margin-top: 1px;
      white-space: nowrap;
    }
    .action-btn-group {
      display: flex;
      align-items: center;
      gap: 0.35rem;
    }
    .btn-view-dossier {
      background: transparent;
      border: 1px solid rgba(8, 127, 140, 0.5);
      color: #77D9C8;
      padding: 0.32rem 0.5rem;
      border-radius: 4px;
      font-size: 0.72rem;
      font-weight: 700;
      cursor: pointer;
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      white-space: nowrap;
      transition: background 0.2s, border-color 0.2s;
    }
    .btn-view-dossier:hover {
      background: rgba(8, 127, 140, 0.25);
      border-color: var(--accent-lime);
      color: var(--accent-lime);
    }
    .btn-print-dossier {
      background: rgba(198, 242, 77, 0.12);
      border: 1px solid rgba(198, 242, 77, 0.35);
      color: var(--accent-lime);
      border-radius: 4px;
      padding: 0.32rem 0.5rem;
      font-size: 0.72rem;
      font-weight: 700;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.25rem;
      white-space: nowrap;
      transition: all 0.2s ease;
    }
    .btn-print-dossier:hover {
      background: var(--accent-lime);
      color: #031E28;
    }
    .btn-print-dossier-modal {
      background: rgba(198, 242, 77, 0.15);
      border: 1px solid rgba(198, 242, 77, 0.4);
      color: var(--accent-lime);
      border-radius: 6px;
      padding: 0.4rem 0.85rem;
      font-size: 0.76rem;
      font-weight: 700;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      transition: all 0.2s ease;
    }
    .btn-print-dossier-modal:hover {
      background: var(--accent-lime);
      color: #031E28;
    }
    .dossier-head-actions {
      display: flex;
      align-items: center;
      gap: 0.75rem;
    }

    /* Tablet & Smaller Desktop Progressive Compaction (768px - 1099px) */
    @media (max-width: 1099px) and (min-width: 768px) {
      .admin-container {
        padding: 1.5rem 1rem;
      }
      .nominations-table th,
      .nominations-table td {
        padding: 0.7rem 0.32rem;
      }
      .col-ref { width: 12.5%; }
      .col-stream { width: 8%; }
      .col-nominee { width: 15.5%; }
      .col-category { width: 21%; }
      .col-nominator { width: 14.5%; }
      .col-status { width: 11.5%; }
      .col-date { width: 7%; }
      .col-action { width: 10%; }
      .ref-badge {
        font-size: 0.72rem;
        padding: 0.15rem 0.25rem;
      }
      .stream-pill {
        font-size: 0.6rem;
        padding: 0.12rem 0.35rem;
      }
      .nominations-table th {
        font-size: 0.65rem;
        letter-spacing: 0.04em;
      }
      .status-select {
        font-size: 0.7rem;
        padding: 0.25rem 0.2rem;
      }
      .date-calendar { font-size: 0.7rem; }
      .date-clock { font-size: 0.65rem; }
      .btn-view-dossier {
        font-size: 0.68rem;
        padding: 0.3rem 0.2rem;
      }
    }

    /* Mobile Stacked Card View (< 768px) */
    @media (max-width: 767px) {
      .admin-container {
        padding: 1.25rem 0.85rem;
      }
      .table-container {
        background: transparent;
        border: none;
        box-shadow: none;
        overflow: visible;
      }
      .nominations-table colgroup,
      .nominations-table thead {
        display: none;
      }
      .nominations-table,
      .nominations-table tbody,
      .nominations-table tr,
      .nominations-table td {
        display: block;
        width: 100%;
        box-sizing: border-box;
      }
      .nominations-table tr {
        background: var(--card-dark);
        border: 1px solid var(--card-border);
        border-radius: 12px;
        margin-bottom: 1.15rem;
        padding: 1.15rem;
        box-shadow: 0 4px 18px rgba(0, 0, 0, 0.25);
      }
      .nominations-table tr:hover {
        border-color: rgba(8, 127, 140, 0.45);
        background: var(--card-dark);
      }
      .nominations-table td {
        padding: 0.48rem 0;
        border-bottom: 1px solid rgba(255, 255, 255, 0.06);
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.25rem;
      }
      .nominations-table td.cell-empty {
        text-align: center;
        padding: 2.5rem 1rem;
        display: block;
      }
      .nominations-table td::before {
        content: attr(data-label);
        font-size: 0.65rem;
        font-weight: 800;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--text-muted);
        display: block;
      }
      .nominations-table td.cell-empty::before {
        display: none !important;
      }
      .nominations-table td.cell-ref {
        padding-top: 0;
      }
      .nominations-table td.cell-ref .ref-badge {
        font-size: 0.88rem;
        padding: 0.25rem 0.55rem;
      }
      .nominations-table td.cell-stream .stream-pill {
        font-size: 0.7rem;
        padding: 0.22rem 0.6rem;
      }
      .nominations-table td.cell-nominee .nominee-primary {
        font-size: 0.95rem;
      }
      .nominations-table td.cell-nominee .nominee-secondary {
        font-size: 0.8rem;
      }
      .nominations-table td.cell-category .category-name {
        font-size: 0.92rem;
        color: #FFFFFF;
      }
      .nominations-table td.cell-nominator .nominator-email {
        font-size: 0.84rem;
      }
      .nominations-table td.cell-nominator .nominator-phone {
        font-size: 0.78rem;
      }
      .nominations-table td.cell-status .status-select {
        font-size: 0.82rem;
        min-height: 44px;
        padding: 0.5rem 0.75rem;
        margin-top: 0.2rem;
      }
      .nominations-table td.cell-date {
        flex-direction: row;
        gap: 0.5rem;
        align-items: baseline;
      }
      .nominations-table td.cell-date .date-calendar,
      .nominations-table td.cell-date .date-clock {
        font-size: 0.82rem;
      }
      .nominations-table td.cell-action {
        border-bottom: none;
        padding-bottom: 0;
        padding-top: 0.75rem;
      }
      .nominations-table td.cell-action .action-btn-group {
        display: flex;
        gap: 0.5rem;
        width: 100%;
      }
      .nominations-table td.cell-action .btn-view-dossier,
      .nominations-table td.cell-action .btn-print-dossier {
        min-height: 44px;
        font-size: 0.82rem;
        padding: 0.65rem 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 1;
      }
    }
    /* Pagination */
    .pagination-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 1.5rem;
      padding: 0 0.5rem;
      font-size: 0.85rem;
      color: var(--text-muted);
    }
    .pagination-links {
      display: flex;
      gap: 0.4rem;
    }
    .page-link {
      background: var(--card-dark);
      border: 1px solid var(--card-border);
      color: #FFFFFF;
      padding: 0.4rem 0.75rem;
      border-radius: 4px;
      text-decoration: none;
      font-weight: 700;
      font-size: 0.8rem;
    }
    .page-link.active {
      background: var(--accent-lime);
      color: #031E28;
      border-color: var(--accent-lime);
    }
    .page-link:hover:not(.active) {
      background: rgba(8, 127, 140, 0.3);
    }
    /* Dossier Modal */
    .dossier-modal {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: rgba(2, 20, 27, 0.85);
      backdrop-filter: blur(8px);
      z-index: 1000;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
    }
    .dossier-modal.active {
      display: flex;
    }
    .dossier-modal-inner {
      background: #031E28;
      border: 1px solid rgba(8, 127, 140, 0.5);
      border-radius: 12px;
      width: 100%;
      max-width: 760px;
      max-height: 90vh;
      overflow-y: auto;
      box-shadow: 0 25px 70px rgba(0, 0, 0, 0.7);
      padding: 2rem;
    }
    .dossier-head {
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      border-bottom: 1px solid rgba(255, 255, 255, 0.1);
      padding-bottom: 1rem;
      margin-bottom: 1.5rem;
    }
    .dossier-close {
      background: transparent;
      border: none;
      color: #A3C2CB;
      font-size: 1.6rem;
      cursor: pointer;
      line-height: 1;
    }
    .dossier-close:hover {
      color: #FFFFFF;
    }
    .dossier-field {
      margin-bottom: 1.25rem;
    }
    .dossier-label {
      font-size: 0.72rem;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--text-muted);
      margin-bottom: 0.3rem;
    }
    .dossier-value {
      font-size: 0.95rem;
      color: #FFFFFF;
      line-height: 1.5;
    }
    .dossier-rationale-box {
      background: #02141B;
      border: 1px solid rgba(8, 127, 140, 0.3);
      border-radius: 8px;
      padding: 1.25rem;
      color: #D5E5E9;
      line-height: 1.7;
      font-size: 0.92rem;
      white-space: pre-wrap;
    }
    .toast-notice {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background: var(--accent-lime);
      color: #031E28;
      font-weight: 800;
      font-size: 0.85rem;
      padding: 0.75rem 1.25rem;
      border-radius: 6px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
      display: none;
      z-index: 2000;
    }

    /* Print media styling for direct browser print (Ctrl+P / Cmd+P) */
    @media print {
      @page {
        size: A4 landscape;
        margin: 10mm 12mm 12mm 12mm;
      }
      body {
        background: #FFFFFF !important;
        color: #000000 !important;
        padding: 0 !important;
      }
      .admin-nav-bar,
      .stats-grid,
      .filter-panel,
      .pagination-bar,
      .cell-action,
      .th-action,
      .toast-notice,
      .dossier-modal {
        display: none !important;
      }
      .table-container {
        border: none !important;
        box-shadow: none !important;
        background: transparent !important;
      }
      .nominations-table {
        color: #000000 !important;
        font-size: 8pt !important;
      }
      .nominations-table th {
        background: #031E28 !important;
        color: #FFFFFF !important;
        border: 1px solid #031E28 !important;
      }
      .nominations-table td {
        border: 1px solid #D1D5DB !important;
        color: #000000 !important;
      }
      .nominations-table .ref-badge,
      .nominations-table .stream-pill {
        border: 1px solid #777777 !important;
        background: transparent !important;
        color: #000000 !important;
      }
      .nominations-table .status-select {
        border: none !important;
        background: transparent !important;
        color: #000000 !important;
        font-weight: 700 !important;
        padding: 0 !important;
        -webkit-appearance: none;
        appearance: none;
      }
      thead {
        display: table-header-group !important;
      }
      tr {
        break-inside: avoid !important;
        page-break-inside: avoid !important;
      }
      .print-only-header {
        display: block !important;
      }
      .print-only-footer {
        display: flex !important;
      }
    }
    .print-only-header,
    .print-only-footer {
      display: none;
    }
  </style>
</head>
<body>

  <!-- Top Admin Navigation Bar -->
  <header class="admin-nav-bar">
    <div class="admin-logo-area">
      <span class="admin-title-badge">INTECARE 2026</span>
      <span class="admin-role-pill">Dossier Registry</span>
    </div>
    <div class="admin-user-menu">
      <span class="admin-user-name"><svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px; margin-right: 4px;"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg><?= htmlspecialchars($adminUser['full_name']) ?></span>
      <a href="../" target="_blank" class="page-link" style="font-size: 0.74rem;">View Public Site ↗</a>
      <a href="logout.php" class="btn-logout">Sign Out</a>
    </div>
  </header>

  <main class="admin-container">

    <!-- Top Statistical Overview Cards -->
    <section class="stats-grid" aria-label="Key registry metrics">
      <div class="stat-card">
        <div class="stat-card-title">Total Submissions</div>
        <div class="stat-card-value lime"><?= number_format($stats['total']) ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Individual Awards</div>
        <div class="stat-card-value"><?= number_format($stats['individual']) ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Corporate Awards</div>
        <div class="stat-card-value"><?= number_format($stats['corporate']) ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Pending Review</div>
        <div class="stat-card-value" style="color: #F59E0B;"><?= number_format($stats['pending']) ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Under Review</div>
        <div class="stat-card-value" style="color: #38BDF8;"><?= number_format($stats['under_review']) ?></div>
      </div>
      <div class="stat-card">
        <div class="stat-card-title">Shortlisted / Approved</div>
        <div class="stat-card-value" style="color: #4ADE80;"><?= number_format($stats['approved']) ?></div>
      </div>
    </section>

    <!-- Search & Filter Controls -->
    <section class="filter-panel" aria-label="Registry filters">
      <form method="GET" action="nominations.php" class="filter-form">
        <div class="filter-group">
          <label for="filterSearch">Search Dossiers</label>
          <input type="text" id="filterSearch" name="search" class="filter-control" placeholder="Ref code, nominee, company, email..." value="<?= htmlspecialchars($search) ?>">
        </div>

        <div class="filter-group">
          <label for="filterStream">Stream</label>
          <select id="filterStream" name="stream" class="filter-control">
            <option value="">All Streams</option>
            <option value="individual" <?= $stream === 'individual' ? 'selected' : '' ?>>Individual (20 Awards)</option>
            <option value="corporate" <?= $stream === 'corporate' ? 'selected' : '' ?>>Corporate (20 Awards)</option>
          </select>
        </div>

        <div class="filter-group">
          <label for="filterCategory">Category</label>
          <select id="filterCategory" name="category" class="filter-control">
            <option value="">All 40 Official Categories</option>
            <?php foreach ($allCategories as $cat): ?>
              <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="filter-group">
          <label for="filterStatus">Status</label>
          <select id="filterStatus" name="status" class="filter-control">
            <option value="">All Statuses</option>
            <option value="Pending Review" <?= $status === 'Pending Review' ? 'selected' : '' ?>>Pending Review</option>
            <option value="Under Review" <?= $status === 'Under Review' ? 'selected' : '' ?>>Under Review</option>
            <option value="Shortlisted" <?= $status === 'Shortlisted' ? 'selected' : '' ?>>Shortlisted</option>
            <option value="Approved" <?= $status === 'Approved' ? 'selected' : '' ?>>Approved</option>
            <option value="Rejected" <?= $status === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
          </select>
        </div>

        <div class="filter-actions">
          <button type="submit" class="btn-filter">
            <span>Filter</span>
          </button>
          <a href="nominations.php" class="btn-reset" title="Reset all filters">Reset</a>
          <a href="export-nominations.php?<?= htmlspecialchars($exportQueryString) ?>" class="btn-export" title="Export current results as CSV">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            <span>Export CSV</span>
          </a>
          <a href="nominations.php?print=register&<?= htmlspecialchars($exportQueryString) ?>" target="_blank" class="btn-print-register" title="Print official A4 landscape register">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            <span>Print A4 Register</span>
          </a>
        </div>
      </form>
    </section>

    <!-- Nominations Data Table -->
    <section class="table-container" aria-label="Nominations list">
      <div class="print-only-header">
        <div style="display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 2px solid #031E28; padding-bottom: 8px; margin-bottom: 12px;">
          <div>
            <div style="font-size: 14pt; font-weight: 900; letter-spacing: 0.05em; color: #031E28; text-transform: uppercase;">INTECARE EXCELLENCE AWARD 2026</div>
            <div style="font-size: 10pt; font-weight: 700; letter-spacing: 0.1em; color: #087F8C;">OFFICIAL NOMINATION REGISTER</div>
          </div>
          <div style="text-align: right; font-size: 8pt; color: #555555;">
            <div><strong>Generated:</strong> <?= date('d M Y, h:i A') ?></div>
            <div><strong>Total Records:</strong> <?= number_format($totalRecords) ?> <?= ($status || $stream || $search) ? '(Filtered)' : '' ?></div>
          </div>
        </div>
      </div>
      <table class="nominations-table">
        <colgroup>
          <col class="col-ref">
          <col class="col-stream">
          <col class="col-nominee">
          <col class="col-category">
          <col class="col-nominator">
          <col class="col-status">
          <col class="col-date">
          <col class="col-action">
        </colgroup>
        <thead>
          <tr>
            <th scope="col" class="th-ref">Reference</th>
            <th scope="col" class="th-stream">Stream</th>
            <th scope="col" class="th-nominee">Nominee / Enterprise</th>
            <th scope="col" class="th-category">Category</th>
            <th scope="col" class="th-nominator">Nominator</th>
            <th scope="col" class="th-status">Status</th>
            <th scope="col" class="th-date">Submitted</th>
            <th scope="col" class="th-action">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($nominations)): ?>
            <tr>
              <td colspan="8" class="cell-empty" style="text-align: center; padding: 3rem 1rem; color: var(--text-muted);">
                No nomination records match your filter criteria.
              </td>
            </tr>
          <?php else: ?>
            <?php foreach ($nominations as $nom): ?>
              <?php
                $statusClass = strtolower(str_replace(' ', '_', $nom['status']));
                $nomineePrimary = $nom['nominee_type'] === 'individual'
                  ? htmlspecialchars($nom['nominee_name'] ?? '—')
                  : htmlspecialchars($nom['company_name'] ?? '—');
                $nomineeSecondary = $nom['nominee_type'] === 'individual'
                  ? htmlspecialchars($nom['nominee_designation'] ?? '')
                  : htmlspecialchars($nom['company_reg'] ?? '');
              ?>
              <tr>
                <td class="cell-ref" data-label="Reference">
                  <span class="ref-badge"><?= htmlspecialchars($nom['tracking_reference']) ?></span>
                </td>
                <td class="cell-stream" data-label="Stream">
                  <span class="stream-pill <?= htmlspecialchars($nom['nominee_type']) ?>">
                    <?= htmlspecialchars(ucfirst($nom['nominee_type'])) ?>
                  </span>
                </td>
                <td class="cell-nominee" data-label="Nominee / Enterprise">
                  <div class="nominee-primary"><?= $nomineePrimary ?></div>
                  <?php if ($nomineeSecondary !== ''): ?>
                    <div class="nominee-secondary"><?= $nomineeSecondary ?></div>
                  <?php endif; ?>
                </td>
                <td class="cell-category" data-label="Category">
                  <span class="category-name"><?= htmlspecialchars($nom['category']) ?></span>
                </td>
                <td class="cell-nominator" data-label="Nominator">
                  <a href="mailto:<?= htmlspecialchars($nom['nominator_email']) ?>" class="nominator-email">
                    <?= htmlspecialchars($nom['nominator_email']) ?>
                  </a>
                  <?php if (!empty($nom['nominator_phone'])): ?>
                    <div class="nominator-phone"><?= htmlspecialchars($nom['nominator_phone']) ?></div>
                  <?php endif; ?>
                </td>
                <td class="cell-status" data-label="Status">
                  <select class="status-select <?= htmlspecialchars($statusClass) ?>" data-id="<?= (int)$nom['id'] ?>" onchange="updateNominationStatus(this)">
                    <option value="Pending Review" <?= $nom['status'] === 'Pending Review' ? 'selected' : '' ?>>Pending Review</option>
                    <option value="Under Review" <?= $nom['status'] === 'Under Review' ? 'selected' : '' ?>>Under Review</option>
                    <option value="Shortlisted" <?= $nom['status'] === 'Shortlisted' ? 'selected' : '' ?>>Shortlisted</option>
                    <option value="Approved" <?= $nom['status'] === 'Approved' ? 'selected' : '' ?>>Approved</option>
                    <option value="Rejected" <?= $nom['status'] === 'Rejected' ? 'selected' : '' ?>>Rejected</option>
                  </select>
                </td>
                <td class="cell-date" data-label="Submitted">
                  <span class="date-calendar"><?= htmlspecialchars(date('d M Y', strtotime($nom['created_at']))) ?></span>
                  <span class="date-clock"><?= htmlspecialchars(date('h:i A', strtotime($nom['created_at']))) ?></span>
                </td>
                <td class="cell-action" data-label="Action">
                  <div class="action-btn-group">
                    <button type="button" class="btn-view-dossier" onclick="openDossierModal(<?= htmlspecialchars(json_encode($nom), ENT_QUOTES, 'UTF-8') ?>)" title="View nomination modal">
                      <span>View</span>
                    </button>
                    <a href="nominations.php?print=dossier&id=<?= (int)$nom['id'] ?>" target="_blank" class="btn-print-dossier" title="Print nomination dossier (A4 portrait)">
                      <svg width="11" height="11" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                      <span>Dossier</span>
                    </a>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
      <div class="print-only-footer" style="justify-content: space-between; align-items: center; border-top: 1px solid #CCCCCC; padding-top: 6px; margin-top: 10px; font-size: 7.5pt; color: #666666;">
        <div>INTECARE Excellence Award 2026 &bull; Secretariat Confidential Registry</div>
        <div>Generated by <?= htmlspecialchars($adminUser['full_name'] ?? 'Admin') ?></div>
      </div>
    </section>

    <!-- Pagination Navigation -->
    <?php if ($totalPages > 1): ?>
      <div class="pagination-bar">
        <div>
          Showing <?= min($totalRecords, $offset + 1) ?> to <?= min($totalRecords, $offset + count($nominations)) ?> of <?= number_format($totalRecords) ?> total dossiers
        </div>
        <div class="pagination-links">
          <?php if ($page > 1): ?>
            <?php $filterQueryArgs['page'] = $page - 1; ?>
            <a href="nominations.php?<?= http_build_query($filterQueryArgs) ?>" class="page-link">← Prev</a>
          <?php endif; ?>

          <?php for ($p = max(1, $page - 2); $p <= min($totalPages, $page + 2); $p++): ?>
            <?php $filterQueryArgs['page'] = $p; ?>
            <a href="nominations.php?<?= http_build_query($filterQueryArgs) ?>" class="page-link <?= $p === $page ? 'active' : '' ?>"><?= $p ?></a>
          <?php endfor; ?>

          <?php if ($page < $totalPages): ?>
            <?php $filterQueryArgs['page'] = $page + 1; ?>
            <a href="nominations.php?<?= http_build_query($filterQueryArgs) ?>" class="page-link">Next →</a>
          <?php endif; ?>
        </div>
      </div>
    <?php endif; ?>

  </main>

  <!-- Dossier Full Detail Modal -->
  <div id="dossierModal" class="dossier-modal" role="dialog" aria-modal="true" aria-labelledby="dossierRefTitle">
    <div class="dossier-modal-inner">
      <div class="dossier-head">
        <div>
          <span style="font-size: 0.72rem; letter-spacing: 0.12em; color: var(--accent-lime); font-weight: 800; text-transform: uppercase;">OFFICIAL DOSSIER RECORD</span>
          <h2 id="dossierRefTitle" style="font-family: var(--font-heading); font-size: 1.5rem; margin: 0.25rem 0 0; color: #FFFFFF;">INT26-XXXXXXXX</h2>
        </div>
        <div style="display: flex; align-items: center; gap: 0.75rem;">
          <a id="modalPrintDossierBtn" href="#" target="_blank" class="btn-print-dossier" style="padding: 0.45rem 0.85rem; font-size: 0.78rem;" title="Print official A4 portrait dossier">
            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
            <span>Print Dossier</span>
          </a>
          <button type="button" class="dossier-close" onclick="closeDossierModal()" aria-label="Close modal">×</button>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="dossier-field">
          <div class="dossier-label">Nomination Stream</div>
          <div class="dossier-value" id="modalStream">—</div>
        </div>
        <div class="dossier-field">
          <div class="dossier-label">Current Status</div>
          <div class="dossier-value" id="modalStatus">—</div>
        </div>
      </div>

      <div class="dossier-field">
        <div class="dossier-label">Official Award Category</div>
        <div class="dossier-value" id="modalCategory" style="font-weight: 700; color: var(--accent-lime);">—</div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="dossier-field">
          <div class="dossier-label" id="modalNomineeLabel">Nominee</div>
          <div class="dossier-value" id="modalNomineeName" style="font-weight: 700;">—</div>
        </div>
        <div class="dossier-field">
          <div class="dossier-label" id="modalSubLabel">Designation / Speciality</div>
          <div class="dossier-value" id="modalNomineeSub">—</div>
        </div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
        <div class="dossier-field">
          <div class="dossier-label">Nominator Official Email</div>
          <div class="dossier-value" id="modalNominatorEmail">—</div>
        </div>
        <div class="dossier-field">
          <div class="dossier-label">Nominator Telephone</div>
          <div class="dossier-value" id="modalNominatorPhone">—</div>
        </div>
      </div>

      <div class="dossier-field">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 0.35rem;">
          <div class="dossier-label" style="margin-bottom: 0;">Executive Summary of Achievements</div>
          <span id="modalWordCount" style="font-size: 0.72rem; color: var(--text-muted); font-weight: 700;">0 words</span>
        </div>
        <div class="dossier-rationale-box" id="modalRationale">—</div>
      </div>

      <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; font-size: 0.78rem; color: var(--text-muted); border-top: 1px solid rgba(255,255,255,0.08); padding-top: 1rem; margin-top: 1.5rem;">
        <div>Submitted: <span id="modalCreatedAt" style="color: #FFFFFF;">—</span></div>
        <div>IP Address: <span id="modalIp" style="color: #FFFFFF;">—</span></div>
      </div>
    </div>
  </div>

  <!-- Toast Notification Feedback -->
  <div id="toastNotice" class="toast-notice" role="status"></div>

  <script>
    const adminCsrfToken = "<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>";

    // Show temporary toast message
    function showToast(message) {
      const toast = document.getElementById('toastNotice');
      if (toast) {
        toast.textContent = message;
        toast.style.display = 'block';
        setTimeout(() => { toast.style.display = 'none'; }, 2800);
      }
    }

    // Interactive Status Update
    async function updateNominationStatus(selectEl) {
      const nomId = selectEl.getAttribute('data-id');
      const newStatus = selectEl.value;

      try {
        const formData = new FormData();
        formData.append('action', 'update_status');
        formData.append('csrf_token', adminCsrfToken);
        formData.append('nomination_id', nomId);
        formData.append('status', newStatus);

        const res = await fetch('nominations.php', {
          method: 'POST',
          body: formData,
          headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();
        if (res.ok && data.success) {
          const emailNotice = data.email_sent ? ' • Nominator notified by email' : (data.email_info ? ' • ' + data.email_info : '');
          showToast(`Status updated: ${newStatus}${emailNotice}`);
          // Update class for visual styling
          selectEl.className = 'status-select ' + newStatus.toLowerCase().replace(' ', '_');
        } else {
          alert('Failed to update status: ' + (data.message || 'Unknown error'));
        }
      } catch (err) {
        alert('A network error occurred while updating status.');
      }
    }

    // Modal Viewer
    function openDossierModal(nom) {
      document.getElementById('dossierRefTitle').textContent = nom.tracking_reference;
      document.getElementById('modalStream').textContent = nom.nominee_type === 'individual' ? 'Individual Excellence Award' : 'Corporate Excellence Award';
      document.getElementById('modalStatus').textContent = nom.status;
      document.getElementById('modalCategory').textContent = nom.category;

      if (nom.nominee_type === 'individual') {
        document.getElementById('modalNomineeLabel').textContent = 'Nominee Full Name';
        document.getElementById('modalNomineeName').textContent = nom.nominee_name || 'N/A';
        document.getElementById('modalSubLabel').textContent = 'Designation / Speciality';
        document.getElementById('modalNomineeSub').textContent = nom.nominee_designation || 'N/A';
      } else {
        document.getElementById('modalNomineeLabel').textContent = 'Company / Organisation';
        document.getElementById('modalNomineeName').textContent = nom.company_name || 'N/A';
        document.getElementById('modalSubLabel').textContent = 'Registration No. / Sector';
        document.getElementById('modalNomineeSub').textContent = nom.company_reg || 'N/A';
      }

      document.getElementById('modalNominatorEmail').textContent = nom.nominator_email;
      document.getElementById('modalNominatorPhone').textContent = nom.nominator_phone;
      document.getElementById('modalRationale').textContent = nom.rationale;

      const words = (nom.rationale || '').trim().split(/\s+/).filter(Boolean).length;
      document.getElementById('modalWordCount').textContent = words + ' words (Max 300)';

      document.getElementById('modalCreatedAt').textContent = nom.created_at;
      document.getElementById('modalIp').textContent = nom.ip_address || 'N/A';

      const printBtn = document.getElementById('modalPrintDossierBtn');
      if (printBtn) {
        printBtn.href = 'nominations.php?print=dossier&id=' + nom.id;
      }

      document.getElementById('dossierModal').classList.add('active');
    }

    function closeDossierModal() {
      document.getElementById('dossierModal').classList.remove('active');
    }

    // Close modal on backdrop click
    document.getElementById('dossierModal').addEventListener('click', (e) => {
      if (e.target === document.getElementById('dossierModal')) {
        closeDossierModal();
      }
    });

    // Close on Escape key
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') closeDossierModal();
    });
  </script>
</body>
</html>

<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — OFFICIAL NOMINATION TRACKING SERVICE
 * 
 * Verifies tracking reference (INT26-XXXXXXXX) server-side via parameterized query.
 * Returns official award category, current status, and visual progress stepper data.
 * Adheres to strict privacy: internal committee remarks and private nominator details are never exposed.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/categories.php';

// Detect if this is an AJAX or API request
$isAjax = (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest')
    || (isset($_SERVER['HTTP_ACCEPT']) && str_contains($_SERVER['HTTP_ACCEPT'], 'application/json'))
    || (isset($_POST['action']) && $_POST['action'] === 'track');

// Handle POST: Perform reference-only status lookup
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json; charset=utf-8');
    header('Cache-Control: no-store, no-cache, must-revalidate, max-age=0');
    header('Pragma: no-cache');

    // 1. Verify CSRF Token
    $submittedToken = (string)($_POST['csrf_token'] ?? '');
    $sessionToken = (string)($_SESSION['csrf_token'] ?? '');
    if (empty($submittedToken) || !hash_equals($sessionToken, $submittedToken)) {
        http_response_code(403);
        echo json_encode([
            'success' => false,
            'title'   => 'SESSION EXPIRED',
            'message' => 'Your security session has expired. Please refresh the page and try again.',
            'csrf_token' => $sessionToken
        ]);
        exit;
    }

    $rawRef = (string)($_POST['tracking_reference'] ?? '');
    // Normalize unicode dashes (en-dash, em-dash, minus, etc.) to standard ASCII hyphen
    $normalizedRef = preg_replace('/[\x{2010}\x{2011}\x{2012}\x{2013}\x{2014}\x{2015}\x{2212}\x{FE58}\x{FE63}\x{FF0D}]/u', '-', $rawRef);
    $trackingRef = strtoupper(trim($normalizedRef));

    // 2. Validate tracking reference format (INT26-XXXXXXXX)
    if ($trackingRef === '' || !preg_match('/^INT26-[A-F0-9]{8}$/i', $trackingRef)) {
        http_response_code(422);
        echo json_encode([
            'success' => false,
            'title'   => 'INVALID REFERENCE FORMAT',
            'message' => 'Please enter a valid tracking reference in the format INT26-XXXXXXXX.',
            'csrf_token' => $sessionToken
        ]);
        exit;
    }

    try {
        $pdo = getDbConnection();

        // 3. Rate limiting check (max 20 lookups per IP per 10 minutes)
        $clientIp = $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
        $limitStmt = $pdo->prepare('
            SELECT COUNT(*) FROM submission_rate_limits
            WHERE ip_address = :ip AND action = "status_track" AND attempted_at > (NOW() - INTERVAL 10 MINUTE)
        ');
        $limitStmt->execute(['ip' => $clientIp]);
        $attempts = (int)$limitStmt->fetchColumn();

        if ($attempts >= 20) {
            http_response_code(429);
            echo json_encode([
                'success' => false,
                'title'   => 'RATE LIMIT EXCEEDED',
                'message' => 'Too many tracking attempts from this network. Please wait a few minutes before trying again.',
                'csrf_token' => $sessionToken
            ]);
            exit;
        }

        // Log lookup attempt for rate limit
        $logStmt = $pdo->prepare('INSERT INTO submission_rate_limits (ip_address, action) VALUES (:ip, "status_track")');
        $logStmt->execute(['ip' => $clientIp]);

        // 4. Secure Reference Query: Parameterized query on tracking reference only
        $stmt = $pdo->prepare('
            SELECT
                tracking_reference,
                nominee_type,
                category,
                nominee_name,
                nominee_designation,
                company_name,
                company_reg,
                status,
                created_at,
                updated_at
            FROM nominations
            WHERE tracking_reference = :ref
            LIMIT 1
        ');
        $stmt->execute(['ref' => $trackingRef]);

        $nom = $stmt->fetch();

        if (!$nom) {
            // Return clean generic error without revealing database information
            http_response_code(404);
            echo json_encode([
                'success' => false,
                'title'   => 'TRACKING REFERENCE NOT FOUND',
                'message' => 'Please check your official tracking reference and try again.',
                'csrf_token' => $sessionToken
            ]);
            exit;
        }

        // 5. Structure visual progress stepper and status data
        $status = (string)$nom['status'];
        $stageIndex = 1; // 1 = Received, 2 = Under Review, 3 = Shortlisted, 4 = Finalist
        $statusKey = 'pending';
        $statusTitle = 'PENDING REVIEW';
        $statusSummary = 'Official registration confirmed. Dossier is in the central intake queue awaiting preliminary verification.';
        $nextSteps = 'The nomination dossier is registered in the central intake queue and awaiting preliminary compliance verification.';

        switch ($status) {
            case 'Under Review':
                $stageIndex = 2;
                $statusKey = 'under_review';
                $statusTitle = 'UNDER REVIEW';
                $statusSummary = 'The Independent Evaluation Committee is actively assessing this nomination against official criteria.';
                $nextSteps = 'Your submission is actively undergoing evaluation by the Independent Evaluation Committee against clinical leadership, operational integrity, and community impact criteria.';
                break;

            case 'Shortlisted':
                $stageIndex = 3;
                $statusKey = 'shortlisted';
                $statusTitle = 'SHORTLISTED';
                $statusSummary = 'Distinguished Achievement: Selected among top contenders for final jury deliberation.';
                $nextSteps = 'Distinguished Achievement: This nomination has been shortlisted among top contenders for final jury review. Further details will be announced ahead of the Gala Presentation.';
                break;

            case 'Approved':
                $stageIndex = 4;
                $statusKey = 'approved';
                $statusTitle = 'GALA FINALIST';
                $statusSummary = 'Officially confirmed as an Excellence Award Finalist for presentation at the Gala Presentation.';
                $nextSteps = 'Official Gala Finalist: The nominee is officially confirmed for presentation at the INTECARE 2026 Gala Dinner on 27 November 2026 at Hotel Royale Chulan Damansara.';
                break;

            case 'Rejected':
                $stageIndex = 2; // Keep at evaluation stage with concluded flag
                $statusKey = 'rejected';
                $statusTitle = 'EVALUATION CONCLUDED';
                $statusSummary = 'Committee assessment has concluded for this category. The nomination is not advancing to this year’s shortlist.';
                $nextSteps = 'The Evaluation Committee has concluded scoring for this category. While not advancing to the final shortlist this year, we commend the nominee’s commendable impact and look forward to future participation.';
                break;

            case 'Pending Review':
            default:
                $stageIndex = 1;
                $statusKey = 'pending';
                $statusTitle = 'PENDING REVIEW';
                $statusSummary = 'Official registration confirmed. Dossier is in the central intake queue awaiting preliminary verification.';
                $nextSteps = 'Your nomination has been securely registered in the central awards registry and is queued for committee assignment.';
                break;
        }

        $nomineeDisplay = $nom['nominee_type'] === 'individual'
            ? ($nom['nominee_name'] . (!empty($nom['nominee_designation']) ? ' — ' . $nom['nominee_designation'] : ''))
            : ($nom['company_name'] . (!empty($nom['company_reg']) ? ' (' . $nom['company_reg'] . ')' : ''));

        $stepperSteps = [
            [
                'step' => 1,
                'name' => 'Dossier Received',
                'description' => 'Securely registered in official registry',
                'state' => $stageIndex > 1 ? 'completed' : ($statusKey === 'pending' ? 'active' : 'completed')
            ],
            [
                'step' => 2,
                'name' => 'Committee Review',
                'description' => 'Evaluated against scoring criteria',
                'state' => $statusKey === 'rejected' ? 'rejected' : ($stageIndex > 2 ? 'completed' : ($stageIndex === 2 ? 'active' : 'upcoming'))
            ],
            [
                'step' => 3,
                'name' => 'Cohort Shortlist',
                'description' => 'Selected for final jury review',
                'state' => $statusKey === 'rejected' ? 'inactive' : ($stageIndex > 3 ? 'completed' : ($stageIndex === 3 ? 'active' : 'upcoming'))
            ],
            [
                'step' => 4,
                'name' => 'Gala Finalist',
                'description' => 'Confirmed for 27 Nov Gala Presentation',
                'state' => $statusKey === 'rejected' ? 'inactive' : ($stageIndex === 4 ? 'completed' : 'upcoming')
            ]
        ];

        echo json_encode([
            'success' => true,
            'csrf_token' => $sessionToken,
            'data' => [
                'tracking_reference' => $nom['tracking_reference'],
                'category'           => $nom['category'],
                'nominee_type'       => $nom['nominee_type'],
                'nominee_display'    => $nomineeDisplay,
                'status'             => $status,
                'status_title'       => $statusTitle,
                'status_summary'     => $statusSummary,
                'status_key'         => $statusKey,
                'current_stage'      => $stageIndex,
                'total_stages'       => 4,
                'steps'              => $stepperSteps,
                'submitted_date'     => date('d M Y, h:i A', strtotime($nom['created_at'])),
                'last_updated'       => date('d M Y, h:i A', strtotime($nom['updated_at'])),
                'next_steps'         => $nextSteps,
                'gala_date'          => 'Friday, 27 November 2026 (7:30 PM - 11:00 PM)',
                'gala_venue'         => 'Grand Ballroom, Hotel Royale Chulan Damansara, Petaling Jaya'
            ]
        ]);
        exit;

    } catch (Exception $e) {
        error_log('[TRACK STATUS ERROR] ' . $e->getMessage());
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'title'   => 'SERVER ERROR',
            'message' => 'An unexpected server error occurred while retrieving nomination status. Please try again later.',
            'csrf_token' => $sessionToken
        ]);
        exit;
    }
}

// -----------------------------------------------------------------------------
// GET Handler: Provide standalone status portal page if opened directly
// -----------------------------------------------------------------------------
$prefillRef = strtoupper(trim((string)($_GET['ref'] ?? $_GET['track'] ?? '')));
$activePage = 'track';
$pageTitle = 'Track Nomination Status — INTECARE Excellence Award 2026';
$pageDescription = 'Enter your official tracking reference to view the latest nomination status and evaluation progress.';

require_once __DIR__ . '/includes/nav.php';
?>

<main class="page-main-wrap" style="padding-top: 100px; padding-bottom: 60px; min-height: 80vh;">
  <div class="container" style="max-width: 840px; margin: 0 auto; padding: 0 1.25rem;">

    <!-- Editorial Page Header -->
    <header class="tracking-page-header">
      <h1 class="tracking-header-title">TRACK NOMINATION STATUS</h1>
      <p class="tracking-header-sub">INTECARE EXCELLENCE AWARD 2026 • 27 NOVEMBER 2026</p>
      <p class="tracking-header-desc">
        Enter your official tracking reference to view the latest nomination status and committee evaluation progression.
      </p>
    </header>

    <!-- Standalone Tracking Card -->
    <div class="tracking-portal-card">
      
      <!-- Lookup Form View -->
      <div id="standaloneLookupFormView">
        <form id="standaloneTrackingForm" novalidate>
          <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token'] ?? '') ?>">

          <div id="standaloneTrackingAlert" class="nomination-alert alert-danger" style="display: none; margin-bottom: 1.25rem;" role="alert"></div>

          <div class="form-group" style="margin-bottom: 1.5rem;">
            <label for="standaloneTrackRef" class="form-label" style="display: block; font-family: var(--font-heading, 'Barlow Condensed', sans-serif); font-size: 0.8rem; font-weight: 800; letter-spacing: 0.12em; text-transform: uppercase; color: #8EAAB4; margin-bottom: 0.5rem;">
              Official Tracking Reference *
            </label>
            <input type="text" id="standaloneTrackRef" name="tracking_reference" class="form-control" placeholder="INT26-XXXXXXXX" value="<?= htmlspecialchars($prefillRef) ?>" required style="text-transform: uppercase; font-family: 'JetBrains Mono', 'SF Mono', monospace; font-size: 1.15rem; letter-spacing: 0.08em; font-weight: 800; background: #062E25; border: 1.5px solid rgba(197, 160, 89, 0.45); color: #FFFFFF; border-radius: 8px; padding: 0.85rem 1rem;">
          </div>

          <button type="submit" class="btn btn-lime btn-lg" style="width: 100%; justify-content: center; font-family: var(--font-heading, 'Barlow Condensed', sans-serif); font-size: 1rem; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase; padding: 0.85rem 1.5rem;">
            <span>CHECK STATUS</span>
            <span class="btn-arrow" aria-hidden="true">→</span>
          </button>
        </form>
      </div>

      <!-- Result View (Hidden until verified) -->
      <div id="standaloneTrackingResultView" style="display: none;">
        <!-- Filled dynamically by main.js -->
      </div>

    </div>

    <!-- Security & Privacy Note (Editorial Style, Strictly No Emojis) -->
    <div style="text-align: center; margin-top: 1.75rem; color: #6E8A93; font-size: 0.78rem; line-height: 1.6; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#C5A059" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" style="flex-shrink: 0;">
        <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
        <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
      </svg>
      <span><strong>Confidentiality Notice:</strong> The tracking portal displays official stage progression only. Evaluator scoring sheets, proprietary rationale statements, and contact details remain strictly confidential under committee bylaws.</span>
    </div>

  </div>
</main>

<?php
require_once __DIR__ . '/includes/footer.php';
require_once __DIR__ . '/includes/nomination-modal.php';
?>

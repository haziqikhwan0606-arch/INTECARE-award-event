<?php
/**
 * INTECARE 2026 — CSV NOMINATION EXPORTER
 * Restricted to authenticated administrators.
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';
requireAdminAuth();

require_once __DIR__ . '/../config/database.php';

try {
    $pdo = getDbConnection();

    // Collect filters
    $search   = trim((string)($_GET['search'] ?? ''));
    $stream   = trim((string)($_GET['stream'] ?? ''));
    $category = trim((string)($_GET['category'] ?? ''));
    $status   = trim((string)($_GET['status'] ?? ''));

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

    $sql = 'SELECT * FROM nominations WHERE ' . implode(' AND ', $where) . ' ORDER BY created_at DESC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);

    $filename = sprintf('intecare-nominations-%s.csv', date('Y-m-d-His'));

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Pragma: no-cache');
    header('Expires: 0');

    $out = fopen('php://output', 'w');

    // Output UTF-8 BOM for Microsoft Excel compatibility
    fwrite($out, "\xEF\xBB\xBF");

    // CSV Header row
    fputcsv($out, [
        'ID',
        'Tracking Reference',
        'Stream',
        'Category',
        'Nominee Full Name',
        'Nominee Designation',
        'Company Name',
        'Company Registration / Sector',
        'Nominator Work Email',
        'Nominator Contact Phone',
        'Status',
        'Word Count',
        'Executive Summary of Achievements',
        'Email Sent Timestamp',
        'Submission Timestamp'
    ]);

    while ($row = $stmt->fetch()) {
        $words = count(preg_split('/\s+/', trim((string)$row['rationale']), -1, PREG_SPLIT_NO_EMPTY));

        fputcsv($out, [
            $row['id'],
            $row['tracking_reference'],
            ucfirst($row['nominee_type']),
            $row['category'],
            $row['nominee_name'] ?? '',
            $row['nominee_designation'] ?? '',
            $row['company_name'] ?? '',
            $row['company_reg'] ?? '',
            $row['nominator_email'],
            $row['nominator_phone'],
            $row['status'],
            $words,
            $row['rationale'],
            $row['email_sent_at'] ?? 'N/A',
            $row['created_at'],
        ]);
    }

    fclose($out);
    exit;

} catch (Exception $e) {
    error_log('[CSV EXPORT ERROR] ' . $e->getMessage());
    http_response_code(500);
    exit('Failed to generate export file.');
}

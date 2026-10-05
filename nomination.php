<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — NOMINATION SUBMISSION API
 * Fully functional backend endpoint handling validation, database persistence,
 * tracking reference generation, and email dispatch.
 */

declare(strict_types=1);

// Configure session cookies securely
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

// Generate CSRF token in session if not present
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

header('Content-Type: application/json; charset=utf-8');
header('X-Content-Type-Options: nosniff');
header('X-Frame-Options: SAMEORIGIN');

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/config/categories.php';
require_once __DIR__ . '/config/mail.php';

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';

// -----------------------------------------------------------------------------
// 1. Handle GET requests (CSRF token fetching or rejection)
// -----------------------------------------------------------------------------
if ($method === 'GET') {
    if (isset($_GET['action']) && $_GET['action'] === 'csrf' || isset($_GET['csrf'])) {
        echo json_encode([
            'success' => true,
            'csrf_token' => $_SESSION['csrf_token']
        ], JSON_UNESCAPED_SLASHES);
        exit;
    }

    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Only POST submissions are accepted by this endpoint.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// Reject any HTTP verb other than POST
if ($method !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'message' => 'Method not allowed. Only POST submissions are accepted by this endpoint.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// -----------------------------------------------------------------------------
// 2. Rate Limiting Protection (Max 10 requests per 60s per session)
// -----------------------------------------------------------------------------
$now = time();
$_SESSION['nomination_attempts'] = array_filter(
    $_SESSION['nomination_attempts'] ?? [],
    fn($t) => ($now - $t) < 60
);
if (count($_SESSION['nomination_attempts']) >= 10) {
    http_response_code(429);
    echo json_encode([
        'success' => false,
        'message' => 'Too many nomination requests. Please wait a moment before trying again.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}
$_SESSION['nomination_attempts'][] = $now;

// -----------------------------------------------------------------------------
// 3. Validate CSRF Protection
// -----------------------------------------------------------------------------
$submittedToken = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
if (!is_string($submittedToken) || !hash_equals($_SESSION['csrf_token'] ?? '', $submittedToken)) {
    http_response_code(403);
    echo json_encode([
        'success' => false,
        'message' => 'Security verification token invalid or expired. Please refresh the page and try again.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// -----------------------------------------------------------------------------
// 3. Rate Limiting Protection (Max 10 submissions per 10 minutes per IP)
// -----------------------------------------------------------------------------
$clientIp = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
try {
    $pdo = getDbConnection();

    // Clean up old rate limit entries (> 1 hour)
    $cleanupStmt = $pdo->prepare('DELETE FROM submission_rate_limits WHERE attempted_at < DATE_SUB(NOW(), INTERVAL 1 HOUR)');
    $cleanupStmt->execute();

    // Check count in last 10 minutes
    $rateStmt = $pdo->prepare(
        'SELECT COUNT(*) FROM submission_rate_limits
         WHERE ip_address = :ip AND action = :action AND attempted_at >= DATE_SUB(NOW(), INTERVAL 10 MINUTE)'
    );
    $rateStmt->execute(['ip' => $clientIp, 'action' => 'nomination_submit']);
    $attemptCount = (int)$rateStmt->fetchColumn();

    if ($attemptCount >= 10) {
        http_response_code(429);
        echo json_encode([
            'success' => false,
            'message' => 'Too many submission attempts from this network. Please wait a few minutes before submitting again.'
        ], JSON_UNESCAPED_SLASHES);
        exit;
    }

    // Log this attempt
    $logAttemptStmt = $pdo->prepare(
        'INSERT INTO submission_rate_limits (ip_address, action) VALUES (:ip, :action)'
    );
    $logAttemptStmt->execute(['ip' => $clientIp, 'action' => 'nomination_submit']);

} catch (Exception $e) {
    // If DB is temporarily unavailable, gracefully log and return 500 without leaking internals
    error_log('[INTECARE NOMINATION ERROR] DB connection failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'An internal database error occurred while initiating your submission. Please try again shortly.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// -----------------------------------------------------------------------------
// 4. Server-Side Data Extraction & Sanitisation
// -----------------------------------------------------------------------------
$nomineeType        = trim((string)($_POST['nomineeType'] ?? ''));
$category           = trim((string)($_POST['category'] ?? ''));
$nomineeName        = trim((string)($_POST['nomineeName'] ?? ''));
$nomineeDesignation = trim((string)($_POST['nomineeDesignation'] ?? ''));
$companyName        = trim((string)($_POST['companyName'] ?? ''));
$companyReg         = trim((string)($_POST['companyReg'] ?? ''));
$nominatorEmail     = trim((string)($_POST['nominatorEmail'] ?? ''));
$nominatorPhone     = trim((string)($_POST['nominatorPhone'] ?? ''));
$rationale          = trim((string)($_POST['rationale'] ?? ''));

$errors = [];

// -----------------------------------------------------------------------------
// 5. Comprehensive Server-Side Validation
// -----------------------------------------------------------------------------

// Nominee Stream validation
if ($nomineeType === '') {
    $errors['nomineeType'] = 'Please select an official nomination stream (Individual or Corporate).';
} elseif (!isValidNomineeType($nomineeType)) {
    $errors['nomineeType'] = 'Invalid nomination stream selected.';
}

// Category validation (Must match official 40 categories and the selected stream)
if ($category === '') {
    $errors['category'] = 'Please select an official award category.';
} elseif (!empty($nomineeType) && isValidNomineeType($nomineeType)) {
    if (!isValidCategory($nomineeType, $category)) {
        $errors['category'] = 'The selected category does not match the chosen nomination stream or is not an official INTECARE 2026 category.';
    }
}

// Stream-specific required fields
if ($nomineeType === 'individual') {
    if ($nomineeName === '') {
        $errors['nomineeName'] = 'Nominee full name with title is required.';
    } elseif (mb_strlen($nomineeName) < 2 || mb_strlen($nomineeName) > 255) {
        $errors['nomineeName'] = 'Nominee name must be between 2 and 255 characters.';
    }

    if ($nomineeDesignation === '') {
        $errors['nomineeDesignation'] = 'Nominee designation or clinical speciality is required.';
    } elseif (mb_strlen($nomineeDesignation) < 2 || mb_strlen($nomineeDesignation) > 255) {
        $errors['nomineeDesignation'] = 'Designation must be between 2 and 255 characters.';
    }
} elseif ($nomineeType === 'corporate') {
    if ($companyName === '') {
        $errors['companyName'] = 'Company or organisation name is required.';
    } elseif (mb_strlen($companyName) < 2 || mb_strlen($companyName) > 255) {
        $errors['companyName'] = 'Company name must be between 2 and 255 characters.';
    }

    if ($companyReg === '') {
        $errors['companyReg'] = 'Company registration number or industry sector is required.';
    } elseif (mb_strlen($companyReg) < 2 || mb_strlen($companyReg) > 255) {
        $errors['companyReg'] = 'Registration number must be between 2 and 255 characters.';
    }
}

// Nominator Email validation
if ($nominatorEmail === '') {
    $errors['nominatorEmail'] = 'Official work email address is required.';
} elseif (!filter_var($nominatorEmail, FILTER_VALIDATE_EMAIL)) {
    $errors['nominatorEmail'] = 'Please provide a valid official email address.';
} elseif (mb_strlen($nominatorEmail) > 255) {
    $errors['nominatorEmail'] = 'Email address cannot exceed 255 characters.';
}

// Nominator Phone validation (supporting international formatting)
if ($nominatorPhone === '') {
    $errors['nominatorPhone'] = 'Contact number is required.';
} else {
    // Check characters: digits, spaces, plus, hyphens, parentheses
    $cleanPhone = preg_replace('/[\s\-\(\)\.]/', '', $nominatorPhone);
    if (!preg_match('/^\+?[0-9]{7,20}$/', $cleanPhone)) {
        $errors['nominatorPhone'] = 'Please enter a valid telephone contact number (e.g. +60 12 345 6789).';
    }
}

// Executive Summary / Rationale validation (Max 300 words strictly enforced)
if ($rationale === '') {
    $errors['rationale'] = 'Executive summary of achievements is required.';
} else {
    // Count words accurately
    $words = preg_split('/\s+/', $rationale, -1, PREG_SPLIT_NO_EMPTY);
    $wordCount = count($words);

    if ($wordCount > 300) {
        $errors['rationale'] = sprintf(
            'Executive summary exceeds the 300-word limit. Your statement currently contains %d words. Please condense your dossier.',
            $wordCount
        );
    } elseif (mb_strlen($rationale) < 20) {
        $errors['rationale'] = 'Please provide a meaningful summary of achievements (minimum 20 characters).';
    }
}

// If validation errors exist, return 422 Unprocessable Entity
if (!empty($errors)) {
    http_response_code(422);
    echo json_encode([
        'success' => false,
        'message' => 'Please correct the highlighted errors in your nomination dossier.',
        'errors'  => $errors
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// -----------------------------------------------------------------------------
// 6. Duplicate Submission Protection (5-minute window for identical submission)
// -----------------------------------------------------------------------------
try {
    $dupCheckStmt = $pdo->prepare(
        'SELECT id FROM nominations
         WHERE nominator_email = :email
           AND category = :cat
           AND nominee_type = :type
           AND COALESCE(nominee_name, "") = :nom_name
           AND COALESCE(company_name, "") = :comp_name
           AND created_at >= DATE_SUB(NOW(), INTERVAL 5 MINUTE)
         LIMIT 1'
    );
    $dupCheckStmt->execute([
        'email'     => $nominatorEmail,
        'cat'       => $category,
        'type'      => $nomineeType,
        'nom_name'  => $nomineeType === 'individual' ? $nomineeName : '',
        'comp_name' => $nomineeType === 'corporate' ? $companyName : '',
    ]);

    if ($dupCheckStmt->fetch()) {
        http_response_code(409);
        echo json_encode([
            'success' => false,
            'message' => 'An identical nomination was recently submitted. Please check your email for your tracking reference or wait a moment.'
        ], JSON_UNESCAPED_SLASHES);
        exit;
    }
} catch (Exception $e) {
    error_log('[INTECARE NOMINATION ERROR] Duplicate check error: ' . $e->getMessage());
}

// -----------------------------------------------------------------------------
// 7. Secure Tracking Reference Generation (INT26-XXXXXXXX)
// -----------------------------------------------------------------------------
function generateTrackingReference(PDO $pdo): string {
    $maxAttempts = 10;
    for ($i = 0; $i < $maxAttempts; $i++) {
        $randomHex = strtoupper(bin2hex(random_bytes(4))); // 8 characters
        $reference = 'INT26-' . $randomHex;

        $checkStmt = $pdo->prepare('SELECT id FROM nominations WHERE tracking_reference = :ref LIMIT 1');
        $checkStmt->execute(['ref' => $reference]);
        if (!$checkStmt->fetch()) {
            return $reference;
        }
    }
    // Fallback if collision persists
    return 'INT26-' . strtoupper(substr(uniqid('', true), -8));
}

$trackingRef = generateTrackingReference($pdo);
$userAgent = substr($_SERVER['HTTP_USER_AGENT'] ?? '', 0, 512);

// -----------------------------------------------------------------------------
// 8. Persist Nomination to Database using Prepared Statements
// -----------------------------------------------------------------------------
try {
    $insertStmt = $pdo->prepare(
        'INSERT INTO nominations (
            tracking_reference,
            nominee_type,
            category,
            nominee_name,
            nominee_designation,
            company_name,
            company_reg,
            nominator_email,
            nominator_phone,
            rationale,
            status,
            ip_address,
            user_agent
        ) VALUES (
            :ref,
            :type,
            :cat,
            :nom_name,
            :nom_desig,
            :comp_name,
            :comp_reg,
            :email,
            :phone,
            :rationale,
            :status,
            :ip,
            :ua
        )'
    );

    $insertStmt->execute([
        'ref'        => $trackingRef,
        'type'       => $nomineeType,
        'cat'        => $category,
        'nom_name'   => $nomineeType === 'individual' ? $nomineeName : null,
        'nom_desig'  => $nomineeType === 'individual' ? $nomineeDesignation : null,
        'comp_name'  => $nomineeType === 'corporate' ? $companyName : null,
        'comp_reg'   => $nomineeType === 'corporate' ? $companyReg : null,
        'email'      => $nominatorEmail,
        'phone'      => $nominatorPhone,
        'rationale'  => $rationale,
        'status'     => 'Pending Review',
        'ip'         => $clientIp,
        'ua'         => $userAgent,
    ]);

    $insertedId = (int)$pdo->lastInsertId();

} catch (PDOException $e) {
    error_log('[INTECARE NOMINATION ERROR] Insert failed: ' . $e->getMessage());
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Unable to record your nomination due to a server error. Please try again or contact the secretariat.'
    ], JSON_UNESCAPED_SLASHES);
    exit;
}

// -----------------------------------------------------------------------------
// 9. Dispatch Email Acknowledgement
// -----------------------------------------------------------------------------
$nominationData = [
    'tracking_reference'  => $trackingRef,
    'nominee_type'        => $nomineeType,
    'category'            => $category,
    'nominee_name'        => $nomineeName,
    'nominee_designation' => $nomineeDesignation,
    'company_name'        => $companyName,
    'company_reg'         => $companyReg,
    'nominator_email'     => $nominatorEmail,
    'nominator_phone'     => $nominatorPhone,
    'rationale'           => $rationale,
];

$emailResult = sendNominationAcknowledgement($nominationData);

if ($emailResult['sent']) {
    try {
        $updateEmailStmt = $pdo->prepare('UPDATE nominations SET email_sent_at = NOW() WHERE id = :id');
        $updateEmailStmt->execute(['id' => $insertedId]);
    } catch (Exception $e) {
        error_log('[INTECARE NOMINATION ERROR] Failed to record email_sent_at: ' . $e->getMessage());
    }
}

// -----------------------------------------------------------------------------
// 10. Regenerate CSRF Token for Security
// -----------------------------------------------------------------------------
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));

// -----------------------------------------------------------------------------
// 11. Return Success Response with Real Tracking Reference
// -----------------------------------------------------------------------------
http_response_code(200);
echo json_encode([
    'success' => true,
    'message' => 'Nomination received successfully and recorded in the official registry.',
    'data' => [
        'tracking_reference'  => $trackingRef,
        'nominee_type'        => $nomineeType,
        'category'            => $category,
        'nominee_name'        => $nomineeName,
        'company_name'        => $companyName,
        'nominator_email'     => $nominatorEmail,
        'status'              => 'Pending Review',
        'created_at'          => date('Y-m-d H:i:s'),
        'email_sent'          => $emailResult['sent'],
        'email_reason'        => $emailResult['sent'] ? 'Email sent successfully' : ($emailResult['reason'] ?? 'SMTP unconfigured'),
    ],
    'csrf_token' => $_SESSION['csrf_token'],
], JSON_UNESCAPED_SLASHES);
exit;

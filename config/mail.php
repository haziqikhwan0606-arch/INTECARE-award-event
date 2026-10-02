<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — EMAIL DISPATCH SERVICE
 * PHPMailer integration with configurable SMTP and fallback logging.
 */

declare(strict_types=1);

if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit('Access Denied');
}

require_once __DIR__ . '/database.php';

// Include Composer autoloader for PHPMailer
$autoloadPath = __DIR__ . '/../vendor/autoload.php';
if (file_exists($autoloadPath)) {
    require_once $autoloadPath;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

/**
 * Returns mail configuration from environment variables or .env file
 */
function getMailConfig(): array {
    $env = loadEnvConfig(__DIR__ . '/../.env');

    return [
        'smtp_enabled'   => filter_var(getenv('SMTP_ENABLED') ?: ($env['SMTP_ENABLED'] ?? false), FILTER_VALIDATE_BOOLEAN),
        'smtp_host'      => getenv('SMTP_HOST') ?: ($env['SMTP_HOST'] ?? 'smtp.gmail.com'),
        'smtp_port'      => (int)(getenv('SMTP_PORT') ?: ($env['SMTP_PORT'] ?? 587)),
        'smtp_user'      => getenv('SMTP_USER') ?: ($env['SMTP_USER'] ?? ''),
        'smtp_pass'      => getenv('SMTP_PASS') ?: ($env['SMTP_PASS'] ?? ''),
        'smtp_secure'    => getenv('SMTP_SECURE') ?: ($env['SMTP_SECURE'] ?? 'tls'), // 'tls' or 'ssl'
        'from_address'   => getenv('MAIL_FROM_ADDRESS') ?: ($env['MAIL_FROM_ADDRESS'] ?? 'awards@intecare.org'),
        'from_name'      => getenv('MAIL_FROM_NAME') ?: ($env['MAIL_FROM_NAME'] ?? 'INTECARE 2026 Secretariat'),
    ];
}

/**
 * Dispatches an official nomination acknowledgement email to the nominator.
 *
 * @param array $nomination Sanitised nomination data dictionary
 * @return array ['sent' => bool, 'reason' => string]
 */
function sendNominationAcknowledgement(array $nomination): array {
    $config = getMailConfig();

    // If SMTP is not explicitly enabled or user/pass is empty, log locally and return
    if (!$config['smtp_enabled'] || empty($config['smtp_user']) || empty($config['smtp_pass'])) {
        $logEntry = sprintf(
            "[%s] [SMTP SKIPPED] Reference: %s | Nominee: %s | Category: %s | Recipient: %s\n",
            date('Y-m-d H:i:s'),
            $nomination['tracking_reference'],
            $nomination['nominee_name'] ?? $nomination['company_name'] ?? 'N/A',
            $nomination['category'],
            $nomination['nominator_email']
        );
        @file_put_contents(__DIR__ . '/../logs/mail.log', $logEntry, FILE_APPEND | LOCK_EX);
        return [
            'sent' => false,
            'reason' => 'SMTP is not configured in the local development environment. Nomination saved successfully.'
        ];
    }

    if (!class_exists(PHPMailer::class)) {
        return [
            'sent' => false,
            'reason' => 'PHPMailer library not found.'
        ];
    }

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_user'];
        $mail->Password   = str_replace(' ', '', $config['smtp_pass']);
        $mail->SMTPSecure = $config['smtp_secure'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $config['smtp_port'];
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 10;

        // Recipients
        $mail->setFrom($config['from_address'], $config['from_name']);
        $mail->addAddress($nomination['nominator_email']);
        $mail->addReplyTo($config['from_address'], $config['from_name']);

        // Content
        $mail->isHTML(true);
        $mail->Subject = sprintf('Official Nomination Receipt [%s] — INTECARE 2026', $nomination['tracking_reference']);

        $ref = htmlspecialchars($nomination['tracking_reference'], ENT_QUOTES, 'UTF-8');
        $cat = htmlspecialchars($nomination['category'], ENT_QUOTES, 'UTF-8');
        $stream = htmlspecialchars(ucfirst($nomination['nominee_type']), ENT_QUOTES, 'UTF-8');
        $name = htmlspecialchars(
            $nomination['nominee_type'] === 'individual'
                ? ($nomination['nominee_name'] . ' (' . ($nomination['nominee_designation'] ?? '') . ')')
                : ($nomination['company_name'] . ' (' . ($nomination['company_reg'] ?? '') . ')'),
            ENT_QUOTES,
            'UTF-8'
        );
        $date = htmlspecialchars(date('d M Y, h:i A T'), ENT_QUOTES, 'UTF-8');

        $bodyHtml = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #021C16; color: #FFFFFF; margin: 0; padding: 24px; }
  .email-card { max-width: 600px; margin: 0 auto; background: #062E25; border: 1px solid rgba(197, 160, 89, 0.35); border-radius: 12px; overflow: hidden; }
  .email-header { background: linear-gradient(135deg, #021C16 0%, #062E25 100%); padding: 32px 28px; text-align: center; border-bottom: 1px solid rgba(197, 160, 89, 0.25); }
  .email-title { font-size: 22px; font-weight: 800; color: #FFFFFF; letter-spacing: 0.05em; margin: 0 0 6px; }
  .email-sub { font-size: 13px; color: #C5A059; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 700; margin: 0; }
  .email-body { padding: 32px 28px; color: #E8F4F7; line-height: 1.7; font-size: 16px; }
  .ref-box { background: rgba(197, 160, 89, 0.1); border: 1px solid rgba(197, 160, 89, 0.35); border-radius: 8px; padding: 18px; text-align: center; margin: 24px 0; }
  .ref-label { font-size: 13px; letter-spacing: 0.12em; text-transform: uppercase; color: #D8EAE4; font-weight: 700; margin-bottom: 6px; }
  .ref-number { font-size: 26px; font-weight: 800; color: #D4AF37; letter-spacing: 0.08em; font-family: monospace; }
  .details-table { width: 100%; border-collapse: collapse; margin-top: 18px; }
  .details-table td { padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.08); font-size: 15.5px; }
  .details-label { color: #B2CDD4; font-weight: 600; width: 38%; }
  .details-value { color: #FFFFFF; font-weight: 700; }
  .status-badge { display: inline-block; background: rgba(197, 160, 89, 0.15); color: #C5A059; border: 1px solid rgba(197, 160, 89, 0.4); padding: 5px 12px; border-radius: 6px; font-size: 13px; font-weight: 800; letter-spacing: 0.08em; }
  .email-footer { background: #01140F; padding: 22px 28px; text-align: center; font-size: 13.5px; color: #8FAAB3; border-top: 1px solid rgba(197, 160, 89, 0.15); line-height: 1.6; }
</style>
</head>
<body>
<div class="email-card">
  <div class="email-header">
    <h1 class="email-title">INTECARE EXCELLENCE AWARD 2026</h1>
    <p class="email-sub">OFFICIAL NOMINATION RECEIPT</p>
  </div>
  <div class="email-body">
    <p>Dear Nominator,</p>
    <p>We confirm receipt of your official nomination dossier for the <strong>INTECARE Excellence Award 2026</strong>. Your submission has been securely registered in the central awards registry.</p>
    
    <div class="ref-box">
      <div class="ref-label">Official Tracking Reference</div>
      <div class="ref-number">{$ref}</div>
    </div>

    <table class="details-table">
      <tr>
        <td class="details-label">Nomination Stream</td>
        <td class="details-value">{$stream} Excellence Award</td>
      </tr>
      <tr>
        <td class="details-label">Award Category</td>
        <td class="details-value">{$cat}</td>
      </tr>
      <tr>
        <td class="details-label">Nominee</td>
        <td class="details-value">{$name}</td>
      </tr>
      <tr>
        <td class="details-label">Submission Timestamp</td>
        <td class="details-value">{$date}</td>
      </tr>
      <tr>
        <td class="details-label">Registry Status</td>
        <td class="details-value"><span class="status-badge">Pending Review</span></td>
      </tr>
    </table>

    <p style="margin-top: 24px; font-size: 14.5px; color: #C5DCE2; line-height: 1.65;">
      <strong>Next Steps:</strong> The Independent Evaluation Committee will review the submitted executive summary against the 2026 criteria. You may be contacted if supplementary documentation or clinical verification is required.
    </p>
  </div>
  <div class="email-footer">
    &copy; 2026 INTECARE Secretariat. Co-organised by HWED &amp; MIHA.<br>
    Royale Chulan Damansara Gala Presentation &bull; 27 November 2026
  </div>
</div>
</body>
</html>
HTML;

        $mail->Body    = $bodyHtml;
        $mail->AltBody = "INTECARE EXCELLENCE AWARD 2026 — NOMINATION RECEIPT\n\n"
            . "Tracking Reference: {$nomination['tracking_reference']}\n"
            . "Stream: " . ucfirst($nomination['nominee_type']) . "\n"
            . "Category: {$nomination['category']}\n"
            . "Status: Pending Review\n\n"
            . "Your nomination dossier has been recorded and is currently pending review by the Evaluation Committee.";

        $mail->send();

        return [
            'sent' => true,
            'message' => 'Acknowledgement email dispatched successfully.'
        ];
    } catch (PHPMailerException $e) {
        $logEntry = sprintf(
            "[%s] [PHPMailer ERROR] %s | To: %s | Ref: %s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $nomination['nominator_email'],
            $nomination['tracking_reference']
        );
        @file_put_contents(__DIR__ . '/../logs/mail.log', $logEntry, FILE_APPEND | LOCK_EX);

        return [
            'sent' => false,
            'reason' => 'Failed to transmit email via SMTP: ' . $e->getMessage()
        ];
    }
}

/**
 * Dispatches an automated status update email when an administrator updates a nomination status.
 *
 * @param array $nomination The nomination database row
 * @param string $oldStatus The previous status
 * @param string $newStatus The updated status
 * @return array ['sent' => bool, 'reason' => string|null]
 */
function sendStatusUpdateNotification(array $nomination, string $oldStatus, string $newStatus): array {
    $config = getMailConfig();

    $ref = htmlspecialchars($nomination['tracking_reference'], ENT_QUOTES, 'UTF-8');
    $cat = htmlspecialchars($nomination['category'], ENT_QUOTES, 'UTF-8');
    $recipient = $nomination['nominator_email'];
    $stream = htmlspecialchars(ucfirst($nomination['nominee_type']), ENT_QUOTES, 'UTF-8');
    $nomineeName = htmlspecialchars(
        $nomination['nominee_type'] === 'individual'
            ? ($nomination['nominee_name'] . (!empty($nomination['nominee_designation']) ? ' (' . $nomination['nominee_designation'] . ')' : ''))
            : ($nomination['company_name'] . (!empty($nomination['company_reg']) ? ' (' . $nomination['company_reg'] . ')' : '')),
        ENT_QUOTES,
        'UTF-8'
    );
    $timestamp = htmlspecialchars(date('d M Y, h:i A T'), ENT_QUOTES, 'UTF-8');

    // Contextual message and next steps based on status
    $statusColor = '#087F8C';
    $statusBg = 'rgba(8, 127, 140, 0.15)';
    $statusBorder = 'rgba(8, 127, 140, 0.4)';
    $statusSummary = '';
    $nextSteps = '';

    switch ($newStatus) {
        case 'Under Review':
            $statusColor = '#38BDF8';
            $statusBg = 'rgba(56, 189, 248, 0.15)';
            $statusBorder = 'rgba(56, 189, 248, 0.4)';
            $statusSummary = 'Your nomination dossier has progressed into formal evaluation by the INTECARE Independent Evaluation Committee.';
            $nextSteps = 'The committee is currently scoring the submitted evidence against official criteria covering clinical leadership, operational integrity, and healthcare impact. No further action is required from you unless supplementary clinical documentation or verification is requested by the secretariat.';
            break;

        case 'Shortlisted':
            $statusColor = '#C5A059';
            $statusBg = 'rgba(197, 160, 89, 0.15)';
            $statusBorder = 'rgba(197, 160, 89, 0.4)';
            $statusSummary = 'Congratulations! Your nomination has been selected for the Official 2026 Shortlist.';
            $nextSteps = 'Your submission is now among the top contenders in this category and has advanced to final jury review. Shortlisted nominees will receive preliminary details regarding the Gala Presentation and citation preview in the coming weeks.';
            break;

        case 'Approved':
            $statusColor = '#4ADE80';
            $statusBg = 'rgba(74, 222, 128, 0.15)';
            $statusBorder = 'rgba(74, 222, 128, 0.4)';
            $statusSummary = 'Distinguished Honour: This nomination has been officially confirmed as an Award Finalist!';
            $nextSteps = 'The nominee is confirmed for formal presentation at the INTECARE Gala Dinner on Friday, 27 November 2026 at the Grand Ballroom, Hotel Royale Chulan Damansara. Our Gala Protocol Secretariat will contact you shortly regarding VIP table allocation, stage presentation details, and accreditation.';
            break;

        case 'Rejected':
            $statusColor = '#F87171';
            $statusBg = 'rgba(248, 113, 113, 0.15)';
            $statusBorder = 'rgba(248, 113, 113, 0.4)';
            $statusSummary = 'The Evaluation Committee has completed its evaluation for the 2026 nomination cohort.';
            $nextSteps = 'Due to exceptionally high submission volumes and rigorous category quotas, this nomination has not advanced to the final shortlist for this cycle. The committee commends the nominee’s commendable contributions to the healthcare community and encourages participation in future award cohorts.';
            break;

        case 'Pending Review':
        default:
            $statusColor = '#F59E0B';
            $statusBg = 'rgba(245, 158, 11, 0.15)';
            $statusBorder = 'rgba(245, 158, 11, 0.4)';
            $statusSummary = 'Your nomination is currently in the intake registry awaiting preliminary review.';
            $nextSteps = 'The dossier is queued for compliance verification by the Secretariat before advancing to the Evaluation Committee.';
            break;
    }

    // If SMTP is not explicitly enabled, log locally and return
    if (!$config['smtp_enabled'] || empty($config['smtp_user']) || empty($config['smtp_pass'])) {
        $logEntry = sprintf(
            "[%s] [STATUS EMAIL SKIPPED - LOCAL DEV] Ref: %s | Nominee: %s | Status: %s -> %s | To: %s\n",
            date('Y-m-d H:i:s'),
            $nomination['tracking_reference'],
            $nomination['nominee_name'] ?? $nomination['company_name'] ?? 'N/A',
            $oldStatus,
            $newStatus,
            $recipient
        );
        @file_put_contents(__DIR__ . '/../logs/mail.log', $logEntry, FILE_APPEND | LOCK_EX);

        return [
            'sent' => false,
            'reason' => 'SMTP is not configured in local development. Notification logged to logs/mail.log.'
        ];
    }

    if (!class_exists(PHPMailer::class)) {
        return [
            'sent' => false,
            'reason' => 'PHPMailer library not found.'
        ];
    }

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host       = $config['smtp_host'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $config['smtp_user'];
        $mail->Password   = str_replace(' ', '', $config['smtp_pass']);
        $mail->SMTPSecure = $config['smtp_secure'] === 'ssl' ? PHPMailer::ENCRYPTION_SMTPS : PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = $config['smtp_port'];
        $mail->CharSet    = 'UTF-8';
        $mail->Timeout    = 10;

        $mail->setFrom($config['from_address'], $config['from_name']);
        $mail->addAddress($recipient);
        $mail->addReplyTo($config['from_address'], $config['from_name']);

        $mail->isHTML(true);
        $mail->Subject = sprintf('Nomination Status Update [%s]: %s — INTECARE 2026', $ref, $newStatus);

        $bodyHtml = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<style>
  body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #021C16; color: #FFFFFF; margin: 0; padding: 24px; }
  .email-card { max-width: 600px; margin: 0 auto; background: #062E25; border: 1px solid rgba(197, 160, 89, 0.35); border-radius: 12px; overflow: hidden; }
  .email-header { background: linear-gradient(135deg, #021C16 0%, #062E25 100%); padding: 32px 28px; text-align: center; border-bottom: 1px solid rgba(197, 160, 89, 0.25); }
  .email-title { font-size: 22px; font-weight: 800; color: #FFFFFF; letter-spacing: 0.05em; margin: 0 0 6px; }
  .email-sub { font-size: 13px; color: #C5A059; letter-spacing: 0.12em; text-transform: uppercase; font-weight: 700; margin: 0; }
  .email-body { padding: 32px 28px; color: #E8F4F7; line-height: 1.7; font-size: 16px; }
  .status-box { background: {$statusBg}; border: 1px solid {$statusBorder}; border-radius: 8px; padding: 20px; text-align: center; margin: 24px 0; }
  .status-label { font-size: 13px; letter-spacing: 0.12em; text-transform: uppercase; color: #D8EAE4; font-weight: 700; margin-bottom: 6px; }
  .status-badge { display: inline-block; color: {$statusColor}; font-size: 22px; font-weight: 800; letter-spacing: 0.08em; text-transform: uppercase; }
  .details-table { width: 100%; border-collapse: collapse; margin-top: 18px; }
  .details-table td { padding: 12px 0; border-bottom: 1px solid rgba(255, 255, 255, 0.08); font-size: 15.5px; }
  .details-label { color: #B2CDD4; font-weight: 600; width: 38%; }
  .details-value { color: #FFFFFF; font-weight: 700; }
  .next-steps-card { background: rgba(197, 160, 89, 0.1); border-left: 4px solid {$statusColor}; padding: 18px; border-radius: 6px; margin-top: 24px; font-size: 15px; color: #E8F4F7; line-height: 1.65; }
  .email-footer { background: #01140F; padding: 22px 28px; text-align: center; font-size: 13.5px; color: #8FAAB3; border-top: 1px solid rgba(197, 160, 89, 0.15); line-height: 1.6; }
</style>
</head>
<body>
<div class="email-card">
  <div class="email-header">
    <h1 class="email-title">INTECARE EXCELLENCE AWARD 2026</h1>
    <p class="email-sub">NOMINATION STATUS UPDATE</p>
  </div>
  <div class="email-body">
    <p>Dear Nominator,</p>
    <p>This is an automated notification from the INTECARE Awards Secretariat regarding your nomination dossier for the <strong>INTECARE Excellence Award 2026</strong>.</p>
    
    <div class="status-box">
      <div class="status-label">Updated Nomination Status</div>
      <div class="status-badge">{$newStatus}</div>
    </div>

    <p style="font-size: 16px; color: #E8F4F7; line-height: 1.65;">{$statusSummary}</p>

    <table class="details-table">
      <tr>
        <td class="details-label">Tracking Reference</td>
        <td class="details-value" style="font-family: monospace; color: #D4AF37;">{$ref}</td>
      </tr>
      <tr>
        <td class="details-label">Nomination Stream</td>
        <td class="details-value">{$stream} Excellence Award</td>
      </tr>
      <tr>
        <td class="details-label">Award Category</td>
        <td class="details-value">{$cat}</td>
      </tr>
      <tr>
        <td class="details-label">Nominee</td>
        <td class="details-value">{$nomineeName}</td>
      </tr>
      <tr>
        <td class="details-label">Effective Date</td>
        <td class="details-value">{$timestamp}</td>
      </tr>
    </table>

    <div class="next-steps-card">
      <strong style="color: #FFFFFF; display: block; margin-bottom: 6px;">Next Steps &amp; Milestone Timeline:</strong>
      {$nextSteps}
    </div>

    <p style="margin-top: 24px; font-size: 14px; color: #A6C5CE; line-height: 1.6;">
      You may verify this status anytime via the official <strong>Track Nomination Status</strong> portal on our website using your Tracking Reference and registered work email.
    </p>
  </div>
  <div class="email-footer">
    &copy; 2026 INTECARE Secretariat. Co-organised by HWED &amp; MIHA.<br>
    Royale Chulan Damansara Gala Presentation &bull; 27 November 2026
  </div>
</div>
</body>
</html>
HTML;

        $mail->Body = $bodyHtml;
        $mail->AltBody = "INTECARE EXCELLENCE AWARD 2026 — NOMINATION STATUS UPDATE\n\n"
            . "Tracking Reference: {$ref}\n"
            . "Category: {$cat}\n"
            . "Nominee: {$nomineeName}\n"
            . "Updated Status: {$newStatus}\n\n"
            . "{$statusSummary}\n\n"
            . "Next Steps:\n{$nextSteps}\n\n"
            . "Track your nomination anytime on the official portal.";

        $mail->send();

        return [
            'sent' => true,
            'message' => 'Status update notification transmitted successfully.'
        ];
    } catch (PHPMailerException $e) {
        $logEntry = sprintf(
            "[%s] [STATUS EMAIL ERROR] %s | To: %s | Ref: %s | Status: %s\n",
            date('Y-m-d H:i:s'),
            $e->getMessage(),
            $recipient,
            $nomination['tracking_reference'],
            $newStatus
        );
        @file_put_contents(__DIR__ . '/../logs/mail.log', $logEntry, FILE_APPEND | LOCK_EX);

        return [
            'sent' => false,
            'reason' => 'Failed to transmit email via SMTP: ' . $e->getMessage()
        ];
    }
}

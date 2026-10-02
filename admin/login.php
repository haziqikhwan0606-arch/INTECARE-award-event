<?php
/**
 * INTECARE 2026 — ADMINISTRATIVE PORTAL LOGIN
 * Secure authentication using password_verify and session regeneration.
 */

declare(strict_types=1);

require_once __DIR__ . '/auth.php';

// Redirect if already authenticated
if (isAdminLoggedIn()) {
    header('Location: nominations.php');
    exit;
}

$errorMessage = '';
$usernameVal = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameVal = trim((string)($_POST['username'] ?? ''));
    $passwordVal = (string)($_POST['password'] ?? '');
    $csrfToken   = (string)($_POST['csrf_token'] ?? '');

    if (!verifyAdminCsrf($csrfToken)) {
        $errorMessage = 'Security token invalid or expired. Please try again.';
    } elseif ($usernameVal === '' || $passwordVal === '') {
        $errorMessage = 'Please enter both your administrative username and password.';
    } else {
        try {
            $pdo = getDbConnection();
            $stmt = $pdo->prepare('SELECT id, username, password_hash, full_name, role FROM admin_users WHERE username = :u LIMIT 1');
            $stmt->execute(['u' => $usernameVal]);
            $user = $stmt->fetch();

            if ($user && password_verify($passwordVal, $user['password_hash'])) {
                // Regenerate session ID to prevent session fixation attacks
                session_regenerate_id(true);

                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_user_id']   = (int)$user['id'];
                $_SESSION['admin_username']  = $user['username'];
                $_SESSION['admin_full_name'] = $user['full_name'];
                $_SESSION['admin_role']      = $user['role'];

                // Update last login timestamp
                $updateStmt = $pdo->prepare('UPDATE admin_users SET last_login_at = NOW() WHERE id = :id');
                $updateStmt->execute(['id' => $user['id']]);

                header('Location: nominations.php');
                exit;
            } else {
                // Throttled delay to mitigate timing & brute-force attacks
                usleep(250000);
                $errorMessage = 'Invalid username or password credentials provided.';
            }
        } catch (Exception $e) {
            error_log('[ADMIN LOGIN ERROR] ' . $e->getMessage());
            $errorMessage = 'A database error occurred. Please contact system support.';
        }
    }
}

$csrfToken = getAdminCsrfToken();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login — INTECARE Excellence Awards 2026</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@500;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/style.css">
  <style>
    body {
      background-color: #021C16;
      color: #FFFFFF;
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1.5rem;
      font-family: var(--font-body);
    }
    .admin-login-box {
      width: 100%;
      max-width: 440px;
      background: #062E25;
      border: 1px solid rgba(197, 160, 89, 0.4);
      border-radius: 12px;
      padding: clamp(2rem, 5vw, 2.75rem);
      box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
      position: relative;
    }
    .admin-login-box::before {
      content: '';
      position: absolute;
      top: 0;
      left: 15%;
      right: 15%;
      height: 3px;
      background: linear-gradient(90deg, transparent, #C5A059, transparent);
    }
    .login-eyebrow {
      font-family: var(--font-heading);
      font-size: 0.8125rem;
      font-weight: 800;
      letter-spacing: 0.14em;
      color: #C5A059;
      text-transform: uppercase;
      margin-bottom: 0.5rem;
      display: block;
    }
    .login-title {
      font-family: var(--font-heading);
      font-size: 1.7rem;
      font-weight: 800;
      color: #FFFFFF;
      line-height: 1.15;
      margin: 0 0 0.5rem;
    }
    .login-sub {
      font-size: 0.96875rem;
      color: #D8EAE4;
      line-height: 1.6;
      margin-bottom: 1.75rem;
    }
    .admin-form-group {
      margin-bottom: 1.25rem;
    }
    .admin-form-label {
      display: block;
      font-size: 0.84rem;
      font-weight: 700;
      letter-spacing: 0.05em;
      color: #D5E5E9;
      margin-bottom: 0.45rem;
      text-transform: uppercase;
    }
    .admin-input {
      width: 100%;
      padding: 0.85rem 1rem;
      background: #021C16;
      border: 1px solid rgba(197, 160, 89, 0.25);
      border-radius: 6px;
      color: #FFFFFF;
      font-family: var(--font-body);
      font-size: 1rem;
      transition: border-color 0.2s, box-shadow 0.2s;
    }
    .admin-input:focus {
      outline: none;
      border-color: #C5A059;
      box-shadow: 0 0 0 3px rgba(197, 160, 89, 0.22);
    }
    .login-error-alert {
      background: rgba(220, 38, 38, 0.15);
      border: 1px solid rgba(239, 68, 68, 0.4);
      color: #FCA5A5;
      padding: 0.85rem 1.1rem;
      border-radius: 6px;
      font-size: 0.9375rem;
      font-weight: 600;
      line-height: 1.5;
      margin-bottom: 1.25rem;
    }
    .btn-admin-submit {
      width: 100%;
      background: #C5A059;
      color: #021C16;
      font-family: var(--font-heading);
      font-weight: 800;
      font-size: 0.96875rem;
      letter-spacing: 0.06em;
      padding: 0.95rem 1.5rem;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 0.5rem;
      transition: background 0.2s, transform 0.2s;
      margin-top: 0.5rem;
      box-shadow: 0 4px 14px rgba(197, 160, 89, 0.3);
    }
    .btn-admin-submit:hover {
      background: #D4AF37;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(197, 160, 89, 0.45);
    }
    .login-footer-links {
      margin-top: 1.5rem;
      text-align: center;
      font-size: 0.875rem;
      color: #8EAAB3;
    }
    .login-footer-links a {
      color: #B5D4DC;
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="admin-login-box">
    <span class="login-eyebrow">RESTRICTED ACCESS</span>
    <h1 class="login-title">INTECARE 2026 Admin Portal</h1>
    <p class="login-sub">Authorised Secretariat and Evaluation Committee members only.</p>

    <?php if ($errorMessage !== ''): ?>
      <div class="login-error-alert" role="alert">
        <?= htmlspecialchars($errorMessage, ENT_QUOTES, 'UTF-8') ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="login.php" autocomplete="off">
      <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($csrfToken, ENT_QUOTES, 'UTF-8') ?>">

      <div class="admin-form-group">
        <label class="admin-form-label" for="username">Username</label>
        <input type="text" id="username" name="username" class="admin-input" required autofocus value="<?= htmlspecialchars($usernameVal, ENT_QUOTES, 'UTF-8') ?>">
      </div>

      <div class="admin-form-group">
        <label class="admin-form-label" for="password">Password</label>
        <input type="password" id="password" name="password" class="admin-input" required>
      </div>

      <button type="submit" class="btn-admin-submit">
        <span>AUTHENTICATE &amp; ENTER</span>
        <span>→</span>
      </button>
    </form>

    <div class="login-footer-links">
      <a href="../">← Return to Public Website</a>
    </div>
  </div>
</body>
</html>

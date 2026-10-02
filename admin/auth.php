<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — ADMIN AUTHENTICATION HELPER
 * Protects administrative routes and manages secure session states.
 */

declare(strict_types=1);

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}

require_once __DIR__ . '/../config/database.php';

/**
 * Checks if the current session is authenticated as an administrator.
 */
function isAdminLoggedIn(): bool {
    return !empty($_SESSION['admin_logged_in']) && !empty($_SESSION['admin_user_id']);
}

/**
 * Enforces admin authentication; redirects unauthorized requests to login page.
 */
function requireAdminAuth(): void {
    if (!isAdminLoggedIn()) {
        $loginUrl = 'login.php';
        header('Location: ' . $loginUrl);
        exit;
    }
}

/**
 * Returns current authenticated admin user record.
 */
function getCurrentAdmin(): ?array {
    if (!isAdminLoggedIn()) {
        return null;
    }
    return [
        'id'        => $_SESSION['admin_user_id'],
        'username'  => $_SESSION['admin_username'] ?? 'Admin',
        'full_name' => $_SESSION['admin_full_name'] ?? 'Administrator',
        'role'      => $_SESSION['admin_role'] ?? 'admin',
    ];
}

/**
 * Generates or validates an admin CSRF token.
 */
function getAdminCsrfToken(): string {
    if (empty($_SESSION['admin_csrf_token'])) {
        $_SESSION['admin_csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['admin_csrf_token'];
}

function verifyAdminCsrf(string $token): bool {
    return !empty($_SESSION['admin_csrf_token']) && hash_equals($_SESSION['admin_csrf_token'], $token);
}

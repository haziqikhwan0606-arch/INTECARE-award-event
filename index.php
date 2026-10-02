<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — HOMEPAGE ENTRY POINT
 * XAMPP Apache / PHP 8+ compatible
 */

if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_httponly' => true,
        'cookie_samesite' => 'Lax',
    ]);
}
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

require_once __DIR__ . '/index.html';

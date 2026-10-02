<?php
/**
 * INTECARE EXCELLENCE AWARD 2026 — DATABASE CONFIGURATION
 * Secure PDO MySQL Connection with Prepared Statements & utf8mb4
 */

declare(strict_types=1);

// Prevent direct web access to sensitive config if accessed directly
if (basename(__FILE__) === basename($_SERVER['SCRIPT_FILENAME'] ?? '')) {
    http_response_code(403);
    exit('Access Denied');
}

/**
 * Load environment configuration from .env if present
 */
function loadEnvConfig(string $path): array {
    $config = [];
    if (file_exists($path) && is_readable($path)) {
        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if ($line === '' || str_starts_with($line, '#')) {
                continue;
            }
            if (str_contains($line, '=')) {
                [$key, $value] = explode('=', $line, 2);
                $key = trim($key);
                $value = trim($value, " \t\n\r\0\x0B\"'");
                $config[$key] = $value;
            }
        }
    }
    return $config;
}

/**
 * Returns a configured PDO database connection instance.
 *
 * @throws RuntimeException If database connection fails
 * @return PDO
 */
function getDbConnection(): PDO {
    static $pdo = null;

    if ($pdo !== null) {
        return $pdo;
    }

    $env = loadEnvConfig(__DIR__ . '/../.env');

    $host = getenv('DB_HOST') ?: ($env['DB_HOST'] ?? '127.0.0.1');
    $port = getenv('DB_PORT') ?: ($env['DB_PORT'] ?? '3306');
    $db   = getenv('DB_NAME') ?: ($env['DB_NAME'] ?? 'intecare');
    $user = getenv('DB_USER') ?: ($env['DB_USER'] ?? 'root');
    $pass = getenv('DB_PASS') !== false ? getenv('DB_PASS') : ($env['DB_PASS'] ?? '');
    $charset = getenv('DB_CHARSET') ?: ($env['DB_CHARSET'] ?? 'utf8mb4');

    $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=%s', $host, $port, $db, $charset);

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES {$charset} COLLATE utf8mb4_unicode_ci",
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
        return $pdo;
    } catch (PDOException $e) {
        // Securely log the error locally without leaking credentials or server paths to users
        error_log(sprintf('[INTECARE DB ERROR] %s in %s:%d', $e->getMessage(), $e->getFile(), $e->getLine()));
        throw new RuntimeException('Unable to establish a secure database connection. Please try again later.');
    }
}

<?php
/**
 * INTECARE 2026 — SEED ADMIN USER
 * Creates default administrator account if one does not already exist.
 */

declare(strict_types=1);

require_once __DIR__ . '/../config/database.php';

try {
    $pdo = getDbConnection();

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM admin_users WHERE username = :user');
    $stmt->execute(['user' => 'admin']);
    $count = (int)$stmt->fetchColumn();

    if ($count === 0) {
        $username = 'admin';
        $defaultPassword = 'Intecare2026!Admin';
        $passwordHash = password_hash($defaultPassword, PASSWORD_DEFAULT);
        $email = 'admin@intecare.org';
        $fullName = 'INTECARE Lead Administrator';

        $insertStmt = $pdo->prepare(
            'INSERT INTO admin_users (username, password_hash, email, full_name, role)
             VALUES (:u, :p, :e, :n, :r)'
        );
        $insertStmt->execute([
            'u' => $username,
            'p' => $passwordHash,
            'e' => $email,
            'n' => $fullName,
            'r' => 'superadmin'
        ]);

        echo "Default admin user created successfully.\n";
        echo "Username: {$username}\n";
        echo "Password: {$defaultPassword}\n";
        echo "Please change this password after your first login.\n";
    } else {
        echo "Admin user 'admin' already exists.\n";
    }
} catch (Exception $e) {
    echo "Error seeding admin: " . $e->getMessage() . "\n";
}

<?php
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../includes/db.php';
use App\Database;

/*
 Run this script once to create the required tables and a default admin.
 Usage: php migrations/create_tables.php
*/

try {

    $pdo = Database::get();


    // If SQL creation block exists earlier, it can be executed here. Migration was already run manually.

    // create default admin if not exists
    $stmt = $pdo->prepare('SELECT id FROM admins WHERE username = :u');
    $stmt->execute([':u' => 'admin']);
    if (!$stmt->fetch()) {
        $hash = password_hash('admin123', PASSWORD_DEFAULT);
        $ins = $pdo->prepare('INSERT INTO admins (username, password_hash) VALUES (:u, :p)');
        $ins->execute([':u' => 'admin', ':p' => $hash]);
        echo "Created default admin user: username=admin password=admin123\n";
    } else {
        echo "Admin user 'admin' already exists.\n";
    }

    echo "Tables created/verified.\n";
} catch (Exception $e) {
    echo "Migration error: " . $e->getMessage() . "\n";
}
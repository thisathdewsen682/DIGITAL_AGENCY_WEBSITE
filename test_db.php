<?php
$host = getenv('DB_HOST') ?: '127.0.0.1';
$db = getenv('DB_NAME') ?: 'agency_db';
$user = getenv('DB_USER') ?: 'devuser';
$pass = getenv('DB_PASS') ?: 'DevPass123';
$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

echo "Testing DB connection...\n";
try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    echo "Connection successful.\n";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage() . "\n";
    echo "DSN: $dsn\n";
    echo "User: $user\n";
    exit(1);
}

// Optional simple query
try {
    $stmt = $pdo->query('SELECT NOW() as now');
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "Server time: " . ($row['now'] ?? 'unknown') . "\n";
} catch (Exception $e) {
    echo "Query error: " . $e->getMessage() . "\n";
}
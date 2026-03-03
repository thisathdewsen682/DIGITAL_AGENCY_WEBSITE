<?php
// Basic PDO connection; replace with your real credentials or environment variables
define('DB_HOST', getenv('DB_HOST') ?: 'localhost');
define('DB_NAME', getenv('DB_NAME') ?: 'agency_db');
define('DB_USER', getenv('DB_USER') ?: 'devuser');
define('DB_PASS', getenv('DB_PASS') ?: 'DevPass123');

try {
    $pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4', DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    // In production, log rather than echoing errors. For local debugging allow detailed output when
    // DEBUG=1 or when running from CLI.
    $debug = getenv('DEBUG') === '1' || getenv('APP_ENV') === 'development' || php_sapi_name() === 'cli';
    error_log('DB connection error: ' . $e->getMessage());
    if ($debug) {
        echo 'Database connection error: ' . $e->getMessage();
    } else {
        echo 'Database connection error.';
    }
    exit;
}
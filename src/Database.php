<?php
namespace App;

use PDO;

class Database
{
    private static ?PDO $instance = null;

    public static function get(): PDO
    {
        if (self::$instance === null) {
            // Try a few common locations for the DB config: project includes folder or environment
            $dbFileCandidates = [
                __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'db.php',
                __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'db.php',
            ];
            $dbFile = null;
            foreach ($dbFileCandidates as $cand) {
                if (file_exists($cand)) {
                    $dbFile = $cand;
                    break;
                }
            }

            if ($dbFile !== null) {
                require_once $dbFile;
            }

            // If includes/db.php did not define constants, fall back to environment variables or defaults
            $host = defined('DB_HOST') ? DB_HOST : (getenv('DB_HOST') ?: '127.0.0.1');
            $name = defined('DB_NAME') ? DB_NAME : (getenv('DB_NAME') ?: 'agency_db');
            $user = defined('DB_USER') ? DB_USER : (getenv('DB_USER') ?: 'devuser');
            $pass = defined('DB_PASS') ? DB_PASS : (getenv('DB_PASS') ?: 'DevPass123');

            $dsn = 'mysql:host=' . $host . ';dbname=' . $name . ';charset=utf8mb4';
            try {
                self::$instance = new PDO($dsn, $user, $pass);
                self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (\Exception $e) {
                throw new \RuntimeException('Failed to connect to database: ' . $e->getMessage());
            }
        }
        return self::$instance;
    }
}

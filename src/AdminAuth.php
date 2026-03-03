<?php
namespace App;

class AdminAuth
{
    public static function attempt(string $username, string $password): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT id, password_hash FROM admins WHERE username = :u LIMIT 1');
        $stmt->execute([':u' => $username]);
        $row = $stmt->fetch(
            \PDO::FETCH_ASSOC
        );
        if ($row && password_verify($password, $row['password_hash'])) {
            if (session_status() === PHP_SESSION_NONE)
                session_start();
            $_SESSION['admin_id'] = $row['id'];
            $_SESSION['admin_user'] = $username;
            return true;
        }
        return false;
    }

    public static function check(): bool
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        return !empty($_SESSION['admin_id']);
    }

    public static function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
        session_unset();
        session_destroy();
    }
}

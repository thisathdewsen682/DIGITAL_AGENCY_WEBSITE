<?php
namespace App;

class Contact
{
    public static function all(): array
    {
        $pdo = Database::get();
        $stmt = $pdo->query('SELECT * FROM contacts ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('INSERT INTO contacts (name, email, message) VALUES (:n, :e, :m)');
        $stmt->execute([':n' => $data['name'], ':e' => $data['email'], ':m' => $data['message']]);
        return (int) $pdo->lastInsertId();
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

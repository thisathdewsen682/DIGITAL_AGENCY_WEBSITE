<?php
namespace App;

class Service
{
    public static function all(): array
    {
        $pdo = Database::get();
        $stmt = $pdo->query('SELECT * FROM services ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find(int $id)
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT * FROM services WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('INSERT INTO services (title, description) VALUES (:t, :d)');
        $stmt->execute([':t' => $data['title'], ':d' => $data['description']]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('UPDATE services SET title = :t, description = :d WHERE id = :id');
        return $stmt->execute([':t' => $data['title'], ':d' => $data['description'], ':id' => $id]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('DELETE FROM services WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

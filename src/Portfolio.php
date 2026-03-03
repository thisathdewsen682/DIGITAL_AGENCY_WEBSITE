<?php
namespace App;

class Portfolio
{
    public static function all(): array
    {
        $pdo = Database::get();
        $stmt = $pdo->query('SELECT * FROM portfolio ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function find(int $id)
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('SELECT * FROM portfolio WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('INSERT INTO portfolio (title, description, image) VALUES (:t, :d, :i)');
        $stmt->execute([':t' => $data['title'], ':d' => $data['description'], ':i' => $data['image'] ?? null]);
        return (int) $pdo->lastInsertId();
    }

    public static function update(int $id, array $data): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('UPDATE portfolio SET title = :t, description = :d, image = :i WHERE id = :id');
        return $stmt->execute([':t' => $data['title'], ':d' => $data['description'], ':i' => $data['image'] ?? null, ':id' => $id]);
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('DELETE FROM portfolio WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}
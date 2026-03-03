<?php
namespace App;

class Testimonial
{
    public static function all(): array
    {
        $pdo = Database::get();
        $stmt = $pdo->query('SELECT * FROM testimonials ORDER BY created_at DESC');
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function create(array $data): int
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('INSERT INTO testimonials (author, content) VALUES (:a, :c)');
        $stmt->execute([':a' => $data['author'], ':c' => $data['content']]);
        return (int) $pdo->lastInsertId();
    }

    public static function delete(int $id): bool
    {
        $pdo = Database::get();
        $stmt = $pdo->prepare('DELETE FROM testimonials WHERE id = :id');
        return $stmt->execute([':id' => $id]);
    }
}

<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
use App\Database;
require_once __DIR__ . '/../includes/admin_header.php';
if (!AdminAuth::check()) {
    header('Location: /admin/login.php');
    exit;
}

// gather simple stats
$pdo = Database::get();
$counts = [];
$tables = ['services', 'portfolio', 'testimonials', 'contacts', 'admins'];
foreach ($tables as $t) {
    try {
        $stmt = $pdo->query("SELECT COUNT(*) as c FROM `" . $t . "`");
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        $counts[$t] = $row['c'] ?? 0;
    } catch (Exception $e) {
        $counts[$t] = 0;
    }
}

ob_start();
?>
<main class="container py-4">
    <h1>Admin Dashboard</h1>
    <p>Welcome, <?php echo htmlspecialchars($_SESSION['admin_user'] ?? ''); ?>. Use the links above to manage content.
    </p>
    <div class="row mt-4">
        <?php foreach ($counts as $table => $c): ?>
        <div class="col-md-2">
            <div class="card p-3">
                <h5><?php echo htmlspecialchars($table); ?></h5>
                <p class="lead"><?php echo (int) $c; ?></p>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</main>
<?php
$body = ob_get_clean();
$pageTitle = 'Admin Dashboard';
require __DIR__ . '/template.php';
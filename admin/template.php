<?php
// Admin template: expects `$pageTitle` and `$body` variables to be set by the caller.
require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../includes/admin_header.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if (empty($pageTitle)) $pageTitle = 'Admin';
?>

<main class="container-fluid admin-content py-4">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 mb-0"><?php echo htmlspecialchars($pageTitle); ?></h1>
        </div>

        <div class="card admin-card p-3">
            <?php echo $body; ?>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
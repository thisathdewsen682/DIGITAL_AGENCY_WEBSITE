<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;

// Process login before sending any HTML/headers
if (session_status() === PHP_SESSION_NONE)
    session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['user'] ?? '';
    $pass = $_POST['pass'] ?? '';
    if (AdminAuth::attempt($user, $pass)) {
        header('Location: /admin/index.php');
        exit;
    } else {
        $error = 'Invalid credentials.';
    }
}

// Use admin header (standalone) so admin pages have their own head/nav
require_once __DIR__ . '/../includes/admin_header.php';

?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="card-title mb-3">Admin Login</h3>
                    <?php if (!empty($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                    <?php endif; ?>
                    <form method="post">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <input name="user" required class="form-control" />
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" name="pass" required class="form-control" />
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
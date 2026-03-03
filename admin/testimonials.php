<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
use App\Testimonial;
require_once __DIR__ . '/../includes/admin_header.php';

if (!AdminAuth::check()) {
    header('Location: /admin/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    if ($action === 'create') {
        Testimonial::create(['author' => $_POST['author'], 'content' => $_POST['content']]);
        header('Location: testimonials.php');
        exit;
    }
    if ($action === 'delete' && !empty($_POST['id'])) {
        Testimonial::delete((int) $_POST['id']);
        header('Location: testimonials.php');
        exit;
    }
}

$items = Testimonial::all();
?>

<main class="container py-4">
    <h1>Manage Testimonials</h1>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Create Testimonial</h5>
                    <form method="post" action="?action=create">
                        <div class="mb-3">
                            <input name="author" placeholder="Author" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <textarea name="content" placeholder="Content" required class="form-control"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <h5>Existing Testimonials</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Author</th>
                        <th>Content</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $it): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($it['author']); ?></td>
                            <td><?php echo htmlspecialchars($it['content']); ?></td>
                            <td><?php echo htmlspecialchars($it['created_at']); ?></td>
                            <td>
                                <form method="post" action="?action=delete" style="display:inline">
                                    <input type="hidden" name="id" value="<?php echo $it['id']; ?>">
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
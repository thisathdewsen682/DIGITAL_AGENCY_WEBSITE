<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
use App\Portfolio;
require_once __DIR__ . '/../includes/admin_header.php';

if (!AdminAuth::check()) {
    header('Location: /admin/login.php');
    exit;
}

$action = $_GET['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create') {
        Portfolio::create(['title' => $_POST['title'], 'description' => $_POST['description'], 'image' => $_POST['image'] ?? null]);
        header('Location: portfolio.php');
        exit;
    }
    if ($action === 'delete' && !empty($_POST['id'])) {
        Portfolio::delete((int) $_POST['id']);
        header('Location: portfolio.php');
        exit;
    }
}

$items = Portfolio::all();
?>

<main class="container py-4">
    <h1>Manage Portfolio</h1>

    <div class="row">
        <div class="col-md-5">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Create Item</h5>
                    <form method="post" action="?action=create">
                        <div class="mb-3">
                            <input name="title" placeholder="Title" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <input name="image" placeholder="Image filename or URL" class="form-control">
                        </div>
                        <div class="mb-3">
                            <textarea name="description" placeholder="Description" class="form-control"></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-7">
            <h5>Existing Items</h5>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($items as $i): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($i['title']); ?></td>
                            <td><?php echo htmlspecialchars($i['image']); ?></td>
                            <td><?php echo htmlspecialchars($i['created_at']); ?></td>
                            <td>
                                <form method="post" action="?action=delete" style="display:inline">
                                    <input type="hidden" name="id" value="<?php echo $i['id']; ?>">
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
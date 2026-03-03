<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
use App\Service;

if (!AdminAuth::check()) {
    header('Location: /admin/login.php');
    exit;
}

$action = $_GET['action'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($action === 'create') {
        Service::create(['title' => $_POST['title'], 'description' => $_POST['description']]);
        header('Location: services.php');
        exit;
    }
    if ($action === 'update' && !empty($_POST['id'])) {
        Service::update((int) $_POST['id'], ['title' => $_POST['title'], 'description' => $_POST['description']]);
        header('Location: services.php');
        exit;
    }
    if ($action === 'delete' && !empty($_POST['id'])) {
        Service::delete((int) $_POST['id']);
        header('Location: services.php');
        exit;
    }
}

$services = Service::all();

ob_start();
?>
<div class="row">
    <div class="col-md-5">
        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Create Service</h5>
                <form method="post" action="?action=create">
                    <div class="mb-3">
                        <input name="title" placeholder="Title" required class="form-control">
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
        <h5>Existing Services</h5>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($services as $s): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($s['title']); ?></td>
                        <td><?php echo htmlspecialchars($s['created_at']); ?></td>
                        <td>
                            <form method="post" action="?action=delete" style="display:inline">
                                <input type="hidden" name="id" value="<?php echo $s['id']; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php
$body = ob_get_clean();
$pageTitle = 'Manage Services';
require __DIR__ . '/template.php';
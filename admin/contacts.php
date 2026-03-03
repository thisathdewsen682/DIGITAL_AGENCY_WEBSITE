<?php
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
use App\Contact;
require_once __DIR__ . '/../includes/admin_header.php';

if (!AdminAuth::check()) {
    header('Location: /admin/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['action'])) {
    if ($_POST['action'] === 'delete' && !empty($_POST['id'])) {
        Contact::delete((int) $_POST['id']);
        header('Location: contacts.php');
        exit;
    }
}

$items = Contact::all();
?>

<main class="container py-4">
    <h1>Contact Submissions</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Message</th>
                <th>Received</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($items as $c): ?>
                <tr>
                    <td><?php echo htmlspecialchars($c['name']); ?></td>
                    <td><?php echo htmlspecialchars($c['email']); ?></td>
                    <td><?php echo nl2br(htmlspecialchars($c['message'])); ?></td>
                    <td><?php echo htmlspecialchars($c['created_at']); ?></td>
                    <td>
                        <form method="post" style="display:inline">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?php echo $c['id']; ?>">
                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
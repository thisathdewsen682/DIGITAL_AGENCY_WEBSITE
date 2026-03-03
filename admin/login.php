<?php
// Simple admin login placeholder
if (session_status() === PHP_SESSION_NONE)
    session_start();

// Replace with real authentication
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // TODO: authenticate
    $_SESSION['admin_logged_in'] = true;
    header('Location: index.php');
    exit;
}

?>

<h1>Admin Login (placeholder)</h1>
<form method="post">
    <label>Username<br><input name="user" /></label><br>
    <label>Password<br><input type="password" name="pass" /></label><br>
    <button type="submit">Login</button>
</form>
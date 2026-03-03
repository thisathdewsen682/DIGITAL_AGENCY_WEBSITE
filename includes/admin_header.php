<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require __DIR__ . '/header.php';
// Simple admin nav
?>
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/admin/index.php">Admin</a>
        <div>
            <a class="nav-link d-inline text-white" href="/admin/services.php">Services</a>
            <a class="nav-link d-inline text-white" href="/admin/portfolio.php">Portfolio</a>
            <a class="nav-link d-inline text-white" href="/admin/testimonials.php">Testimonials</a>
            <a class="nav-link d-inline text-white" href="/admin/contacts.php">Contacts</a>
            <a class="nav-link d-inline text-white" href="/admin/logout.php">Logout</a>
        </div>
    </div>
</nav>
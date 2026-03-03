<?php
if (session_status() === PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Agency</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link rel="stylesheet" href="/assets/css/admin.css">
</head>

<body>

    <div class="d-flex flex-column min-vh-100">

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
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agency</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">Agency</a>
            <div>
                <a class="nav-link d-inline" href="/about.php">About</a>
                <a class="nav-link d-inline" href="/services.php">Services</a>
                <a class="nav-link d-inline" href="/portfolio.php">Portfolio</a>
                <a class="nav-link d-inline" href="/contact.php">Contact</a>
            </div>
        </div>
    </nav>
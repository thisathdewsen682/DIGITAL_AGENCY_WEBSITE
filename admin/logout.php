<?php
if (session_status() === PHP_SESSION_NONE)
    session_start();
require_once __DIR__ . '/../autoload.php';
use App\AdminAuth;
AdminAuth::logout();
header('Location: /admin/login.php');
exit;

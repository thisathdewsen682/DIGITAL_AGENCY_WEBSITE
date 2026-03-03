<?php
function e($s)
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function redirect($url)
{
    header('Location: ' . $url);
    exit;
}

function is_admin_logged_in()
{
    return !empty($_SESSION['is_admin']);
}

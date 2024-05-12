<?php

require_once (DIR . '/app/models/profile.php');
if (isset($_COOKIE['session']) && $path === '/') {
    header('Location: /chat');
}

if (!isset($_COOKIE['session']) && $path !== '/' && $path !== '/term') {
    header('Location: /');
}
if (isset($_COOKIE['session']))
    $user = getData($_COOKIE['session']);

if (isset($user) && $path == '/admin' && $user[0]['role'] !== 0) {
    header('Location: /');
}

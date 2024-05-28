<?php

require_once(DIR . '/app/models/profile.php');
if (isset($_COOKIE['session']) && $path === '/') {
    header('Location: /profile');
}


if (!isset($_COOKIE['session']) && $path !== '/' && $path !== '/term') {
    header('Location: /');
}


if (isset($_COOKIE['session']))
    $user = getData($_COOKIE['session']);

if (isset($user) &&  str_starts_with($path, '/admin') && $user[0]['role'] !== 0) {
    header('Location: /');
}

if (isset($user) &&  $path !== '/' && $user[0]['ban'] !== 0) {
    setcookie("session", "", time() - 3600, "/");
    header("Location: /");
}
if (isset($user) &&  str_starts_with($path, '/fastcheck') && $user[0]['role'] !== 1) {
    header('Location: /');
}

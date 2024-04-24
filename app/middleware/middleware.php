<?php
if (!isset($_COOKIE['session']) && $path !== '/' && $path !== '/term') {
    header('Location: /');
}

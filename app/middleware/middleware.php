<?php
if (!isset($_COOKIE['session']) && $path !== '/') {
    header('Location: /');
}

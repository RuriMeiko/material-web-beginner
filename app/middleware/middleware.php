<?php
if (!isset($_COOKIE['session'])) {
    require __DIR__ . $viewDir . 'login/index.php';
}

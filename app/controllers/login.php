<?php
require_once(DIR . '/app/models/login.php');

if (isset($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    loginUser($username, $password);
}

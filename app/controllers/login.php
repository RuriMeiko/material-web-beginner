<?php
require_once (DIR . '/app/models/login.php');

if (isset($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $status = loginUser($username, $password);
    if ($status) {
        setcookie("session", $status, time() + 3600, "/");

    } else {
        http_response_code(403);
        echo json_encode(["mess" => "failed to login"]);
    }
}

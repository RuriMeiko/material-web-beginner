<?php
require_once(DIR . '/app/models/login.php');

if (isset($_POST) && isset($_POST["username"]) && isset($_POST["password"])) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $status = loginUser($username, $password);
    echo ($status);
    if ($status === "Ban") {
        http_response_code(405);
        echo json_encode(["mess" => "ban"]);
        exit();
    }
    if ($status === "Wrong") {
        http_response_code(403);
        echo json_encode(["mess" => "failed to login"]);
        exit();
    } else {
        setcookie("session", $status, time() + 3600, "/");
        exit();
    }
} else {
    http_response_code(500);
    echo "Có lỗi xảy ra!";
}

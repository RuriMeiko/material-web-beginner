<?php
require_once(DIR . '/app/models/login.php');

if (isset($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $birthday = $_POST["birthday"];
    $gender = $_POST["gender"];
    $location = $_POST["location"];
    registerUser($username, $password, $name, $birthday, $gender, $location);
}

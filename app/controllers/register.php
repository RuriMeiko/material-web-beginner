<?php
require_once(DIR . '/app/models/login.php');

if (isset($_POST)) {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $birddate = $_POST["birddate"];
    $gender = $_POST["gender"];
    $location = $_POST["location"];
    registerUser($username, $password, $name, $birddate, $gender, $location);
}

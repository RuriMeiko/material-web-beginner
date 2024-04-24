<?php
if (isset($_GET)) {
    setcookie("session", "", time() - 3600, "/");
    header("Location: /login");
}
?>
<?php
require_once(DIR .'/config/database.php');

function updateRoles($accounts, $newRole) {
    $conn = createConn();
    $success = true;
    $accounts = json_decode($accounts);
    if (!is_array($accounts)) {
        return false;
    }
    foreach ($accounts as $account) {
        $updateQuery = "UPDATE user_login SET role = ? WHERE username = ?";
        $updateResult = executeQuery($conn, $updateQuery, [$newRole, $account]);

        if (!$updateResult) {
            $success = false;
            break; 
        }
    }

    return $success;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Đăng nhập</title>
    <?php require_once (DIR . '/public/styles/styleGlobal.php'); ?>
</head>

<body>
<div class="box">
        <div class="fetch_btn_container">
            <table id="user_table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Birthdate</th>
                        <th>Gender</th>
                        <th>Location</th>
                        <th>Role</th>
                        <th>Admin</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody id="user_data">
                </tbody>
            </table>
            <input type="checkbox" id="admin_checkbox"> Admin Role
            <button id="set_role_btn" onclick="setRole()">Set Role</button>
        </div>
    </div>
    <script src="/public/js/getUserData.js"></script>

</body>

</html>
<?php
require_once(DIR . '/app/controllers/profile.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đổi mật khẩu</title>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/form.css" />
    <link rel="stylesheet" href="/public/css/profile.css" />
    <link rel="stylesheet" href="/public/css/header.css" />

</head>

<body>
    <div class="body-container">
        <?php require_once DIR . "/app/views/component/header.php" ?>
        <div class="box">
        <md-elevation></md-elevation>

            <form class="formPassword">
                <div class='title-profile'>
                    <h1>Cập nhật mật khẩu</h1>
                    <input type="text" hidden name='username' value="<?php echo $datanguoidung[0]['username'] ?>">
                    <div class='title-profile'>

                        <md-filled-tonal-icon-button id="change-info" href="/profile">
                            <md-icon>Person</md-icon>
                        </md-filled-tonal-icon-button>

                    </div>

                </div>
                <md-divider inset id='title-divider'></md-divider>


                <!-- <md-divider inset></md-divider> -->
                <!-- <h3>Cập nhật mật khẩu:</h3>
                <div class="two-container">
                    <md-outlined-text-field prefix-text="🔒" aria-label="Password" class="passwordInput" type="password" name="password" autocomplete="new-password" label="Mật khẩu" placeholder="Nhập mật khẩu của bạn">
                        <md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
                            <md-icon>visibility</md-icon>
                            <md-icon slot="selected">visibility_off</md-icon>
                        </md-icon-button></md-outlined-text-field>
                    <md-outlined-text-field prefix-text="🔐" aria-label="Re-Password" name='repassword' type="password" autocomplete="off" label="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu của bạn">
                    </md-outlined-text-field>
                </div>
                <md-divider inset></md-divider> -->
                <h3>Mật khẩu cũ:</h3>
                <md-outlined-text-field class="passwordInput" type="password" prefix-text="🔒" aria-label="current-password" label="Mật khẩu hiện tại" name="currentpassword" autocomplete="current-password" placeholder="Nhập mật khẩu hiện tại">
                    <md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
                        <md-icon>visibility</md-icon>
                        <md-icon slot="selected">visibility_off</md-icon>
                    </md-icon-button>
                </md-outlined-text-field>
                <md-divider inset></md-divider>

                <h3>Mật khẩu mới:</h3>

                <md-outlined-text-field class="passwordInput" type="password" prefix-text="🔏" aria-label="new-password" label="Mật khẩu mới" name="newpassword" autocomplete="new-password" placeholder="Nhập mật khẩu mới">
                    <md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
                        <md-icon>visibility</md-icon>
                        <md-icon slot="selected">visibility_off</md-icon>
                    </md-icon-button>
                </md-outlined-text-field>

                <md-outlined-text-field type="password" prefix-text="🔐" aria-label="new-password" label="Nhập lại mật khẩu mới" name="repassword" autocomplete="new-password" placeholder="Nhập lại mật khẩu mới">
                </md-outlined-text-field>
                <md-divider inset></md-divider>
                <md-filled-button id="save-btn">Lưu</md-filled-button>

                <md-linear-progress class="loading" indeterminate></md-linear-progress>
            </form>
        </div>
        <script src="/public/js/profile.js"></script>
    </div>
</body>

</html>
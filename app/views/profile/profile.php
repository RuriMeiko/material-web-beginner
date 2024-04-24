<?php
// Kiểm tra nếu cookie và session đều tồn tại và đang đăng nhập
require_once(DIR . '/app/controllers/profile.php');

if (!isset($_COOKIE['session'])) {

    // Người dùng chưa đăng nhập
    header("Location: /");
} else {
    $datanguoidung = getData($_COOKIE['session']);
    if ($datanguoidung[0]['role'] === 0) {
        header("Location: /admin");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin người dùng</title>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <script src="/public/js/profile.js"></script>
    <link rel="stylesheet" href="/public/css/form.css" />
    <link rel="stylesheet" href="/public/css/profile.css" />

</head>

<body>
    <div class="box">
        <form class="formInfo">
            <div class='title-profile'>
                <h1>Xin chào @<?php echo $datanguoidung[0]['username'] ?></h1>
                <md-icon-button href="https://google.com">
                    <md-icon>logout</md-icon>
                </md-icon-button>
            </div>

            <div class="avatar-container">
                <div class='avatar-select'>
                    <md-elevation></md-elevation>

                    <div class='sellect'>
                        <md-ripple></md-ripple>
                        <md-elevation></md-elevation>
                        <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" onchange="previewAvatar(event)" />
                        Chọn ảnh
                    </div>
                    <img id="avatar-preview" class="avatar-preview mb-4" src="<?php if (isset($datanguoidung[0]['avt'])) echo $datanguoidung[0]['avt'];
                                                                                else echo '/public/images/defaultAvt.jpg' ?>" />
                </div>
            </div>
            <md-divider inset></md-divider>
            <h3>Cập nhật mật khẩu:</h3>
            <div class="two-container">
                <md-outlined-text-field prefix-text="🔒" aria-label="Password" required class="passwordInput" type="password" name="password" autocomplete="new-password" label="Mật khẩu" placeholder="Nhập mật khẩu của bạn">
                    <md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
                        <md-icon>visibility</md-icon>
                        <md-icon slot="selected">visibility_off</md-icon>
                    </md-icon-button></md-outlined-text-field>
                <md-outlined-text-field prefix-text="🔐" aria-label="Re-Password" required type="password" autocomplete="off" label="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu của bạn">
                </md-outlined-text-field>
            </div>
            <md-divider inset></md-divider>
            <h3>Cập nhật thông tin:</h3>

            <md-outlined-text-field prefix-text="🤔" aria-label="name" required label="Họ và tên" name="name" autocomplete="name" placeholder="Nhập tên của bạn">
            </md-outlined-text-field>
            <div class="two-container">
                <md-outlined-text-field type="date" prefix-text="🗓️" aria-label="birddate" required label="Ngày sinh" autocomplete="bday" placeholder="Nhập tên đăng nhập của bạn" name="birddate">
                </md-outlined-text-field>
                <md-outlined-select required label="Giới tính" aria-label="Giới tính" name="gender">
                    <md-select-option selected value="Không tiết lộ">
                        <div slot="headline">Không tiết lộ</div>
                    </md-select-option>
                    <md-select-option value="Nam">
                        <div slot="headline">Nam</div>
                    </md-select-option>
                    <md-select-option value="Nữ">
                        <div slot="headline">Nữ</div>
                    </md-select-option>
                </md-outlined-select>
            </div>
            <md-outlined-text-field prefix-text="🏠" aria-label="quê quán" required label="Quê quán" name="location" autocomplete="street-address" placeholder="Nhập tên địa chỉ của bạn">
            </md-outlined-text-field>
            <md-divider inset></md-divider>
            <md-filled-button>Lưu</md-filled-button>
            <md-linear-progress class="loading" indeterminate></md-linear-progress>
        </form>
    </div>
</body>

</html>
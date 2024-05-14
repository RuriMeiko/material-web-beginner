<?php
require_once(DIR . '/app/controllers/profile.php');
?>

<div class="box popup">
    <form class="formInfo">
        <div class='title-profile'>
            <h1 id='title'>Chào <?php echo checkTime() ?><span>@<?php echo $datanguoidung[0]['username'] ?></span>
            </h1>
            <input type="text" hidden name='username' value="<?php echo $datanguoidung[0]['username'] ?>">
            <div class='title-profile'>
                <?php if ($datanguoidung[0]['role'] === 0)
                    echo '
        <md-filled-tonal-icon-button href="/admin">
            <md-icon>Admin_Panel_Settings</md-icon>
        </md-filled-tonal-icon-button>' ?>
                <md-filled-tonal-icon-button href="/api/logout">
                    <md-icon>logout</md-icon>
                </md-filled-tonal-icon-button>

            </div>

        </div>
        <md-divider inset id='title-divider'></md-divider>

        <div class="avatar-container">
            <div class='avatar-select'>
                <md-elevation></md-elevation>

                <div class='sellect'>
                    <md-ripple></md-ripple>
                    <md-elevation></md-elevation>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" onchange="previewAvatar(event)" />
                    Chọn ảnh
                </div>
                <img class="avatar-preview" class="avatar-preview mb-4" src="<?php if (isset($datanguoidung[0]['avt']))
                                                                                echo $datanguoidung[0]['avt'];
                                                                            else
                                                                                echo '/public/images/defaultAvt.jpg' ?>" />
            </div>
        </div>
        <!-- <md-divider inset></md-divider> -->
        <h3>Cập nhật mật khẩu:</h3>
        <div class="two-container">
            <md-outlined-text-field prefix-text="🔒" aria-label="Password" class="passwordInput" type="password" name="password" autocomplete="new-password" label="Mật khẩu" placeholder="Nhập mật khẩu của bạn">
                <md-icon-button toggle slot="trailing-icon" class="eyesToggle" aria-label="Hiển thị mật khẩu">
                    <md-icon>visibility</md-icon>
                    <md-icon slot="selected">visibility_off</md-icon>
                </md-icon-button></md-outlined-text-field>
            <md-outlined-text-field prefix-text="🔐" aria-label="Re-Password" name='repassword' type="password" autocomplete="off" label="Nhập lại mật khẩu" placeholder="Nhập lại mật khẩu của bạn">
            </md-outlined-text-field>
        </div>
        <md-divider inset></md-divider>
        <h3>Cập nhật thông tin:</h3>
        <md-outlined-text-field prefix-text="😎" aria-label="name" label="Họ và tên" name="name" autocomplete="name" placeholder="Nhập tên của bạn" value="<?php echo $datanguoidung[0]['name'] ?>">
        </md-outlined-text-field>
        <div class="two-container">
            <md-outlined-text-field type="date" prefix-text="🗓️" aria-label="birthday" label="Ngày sinh" autocomplete="bday" placeholder="Nhập ngày sinh của bạn" name="birthday" value="<?php echo $datanguoidung[0]['birthday'] ?>">
            </md-outlined-text-field>
            <md-outlined-select label="Giới tính" aria-label="Giới tính" name="gender">
                <md-select-option <?php if ($datanguoidung[0]['gender'] == 0)
                                        echo 'selected' ?> value="0">
                    <div slot="headline">🤫 Khác</div>
                </md-select-option>
                <md-select-option value="1" <?php if ($datanguoidung[0]['gender'] == 1)
                                                echo 'selected' ?>>
                    <div slot="headline">👨 Nam</div>
                </md-select-option>
                <md-select-option value="2" <?php if ($datanguoidung[0]['gender'] == 2)
                                                echo 'selected' ?>>
                    <div slot="headline">👩 Nữ</div>
                </md-select-option>
            </md-outlined-select>
        </div>
        <md-outlined-text-field prefix-text="🏠" aria-label="quê quán" label="Quê quán" name="location" autocomplete="street-address" placeholder="Nhập tên địa chỉ của bạn" value="<?php echo $datanguoidung[0]['location'] ?>">
        </md-outlined-text-field>
        <md-divider inset></md-divider>
        <md-filled-button id="save-btn">Lưu</md-filled-button>

        <md-linear-progress class="loading" indeterminate></md-linear-progress>
    </form>
    <script src="/public/js/profile.js"></script>
</div>
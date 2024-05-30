<?php
require_once(DIR . '/app/controllers/profile.php');
?>

<div class="box popupnewfriend">
    <form class="formInfo">

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
        <h3>Đặt tên cuộc trò chuyện:</h3>
        <md-outlined-text-field prefix-text="😎" aria-label="name" label="Tên..." name="name" autocomplete="name" placeholder="Nhập tên cuộc trò chuyện">

        </md-outlined-text-field>


        <md-divider inset></md-divider>
        <md-filled-button id="save-btn">Gửi</md-filled-button>

        <md-linear-progress class="loading" indeterminate></md-linear-progress>
    </form>
    <script src="/public/js/profile.js"></script>
</div>
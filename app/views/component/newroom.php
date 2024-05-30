<?php
require_once(DIR . '/app/controllers/profile.php');
?>

<div class="box popupnewfriend">
    <form id="newroom-info" class="formInfo">


        <div class="avatar-container">
            <div class='avatar-select'>
                <md-elevation></md-elevation>

                <div class='sellect'>
                    <md-ripple></md-ripple>
                    <md-elevation></md-elevation>
                    <input type="file" id="avatar" name="avatar" accept="image/png, image/jpeg" onchange="previewAvatar(event)" />
                    Chọn ảnh
                </div>
                <img id="newroom-review" class="avatar-preview" class="avatar-preview mb-4" src="<?php if (isset($datanguoidung[0]['avt']))
                                                                                                        echo $datanguoidung[0]['avt'];
                                                                                                    else
                                                                                                        echo '/public/images/defaultAvt.jpg' ?>" />
            </div>
        </div>
        <!-- <md-divider inset></md-divider> -->
        <h3>Đặt tên cuộc trò chuyện:</h3>
        <md-outlined-text-field id="nameroomchat" required prefix-text="😎" aria-label="name" label="Tên..." name="cretaName" autocomplete="name" placeholder="Nhập tên cuộc trò chuyện">

        </md-outlined-text-field>


        <md-divider inset></md-divider>
        <md-filled-button id="next-newroom-btn">Tiếp</md-filled-button>

        <md-linear-progress class="loading" indeterminate></md-linear-progress>
    </form>
    <form id="newroom-member" class="formInfo">



        <!-- <md-divider inset></md-divider> -->
        <h3>Chọn thành viên:</h3>
        <div class="member-container">
            <md-outlined-text-field id="find-newroom" required prefix-text="😎" aria-label="name" label="Tìm kiếm tên người dùng" name="cretaName" autocomplete="name" placeholder="Nhập tên người dùng">

            </md-outlined-text-field>
            <?php if (count($allContacts) > 0) { ?>
                <?php foreach ($allContacts as $id => $messages) {
                    $lastMessage = end($messages);
                ?>
                    <div id="member_<?php echo $id ?>" class="item-user">
                        <md-elevation></md-elevation>
                        <md-ripple></md-ripple>
                        <div class='from-user'>
                            <div class='avatar-select avt'>
                                <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                            </div>
                        </div>
                        <div class="container">
                            <div class='name-user'><?php echo $lastMessage['name'] ?></div>
                        </div>
                    </div>
            <?php }
            }  ?>


        </div>
        <md-divider inset></md-divider>
        
        <md-filled-button id="find-newroom-btn">Tìm</md-filled-button>
        
        <md-filled-button id="f-newroom-btn">Tạo</md-filled-button>
        <md-filled-button id="add-curr-btn">Thêm</md-filled-button>

        <md-linear-progress class="loading" indeterminate></md-linear-progress>
    </form>
    <script src="/public/js/newroom.js"></script>
</div>
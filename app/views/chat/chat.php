<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Người dùng</title>
    <link rel="stylesheet" href="/public/css/profile.css" />

    <?php require_once(DIR . '/app/controllers/chat/chat.php');
    ?>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/chat.css" />
    <link rel="stylesheet" href="/public/css/form.css" />
    <script src="/public/js/chat.js"></script>

</head>

<body>
    <script>
        const listChat = <?php print_r(json_encode($mergedMessages)) ?>;
        const listMember = <?php print_r(json_encode($mergedMembers)) ?>;
    </script>
    <div class="chat">
        <div class="nullchatscrene">
            <div class="nullchatscrene-massange">Chọn kênh để bắt đầu nhắn tin</div>
        </div>
        <div class="chatscrene">
            <div class="title-chat">
                <md-elevation></md-elevation>
                <div class='from-user'>
                    <div class='avatar-select avt avt-title'>
                        <img class="avatar-preview" class="avatar-preview mb-4" src='<?php if (isset($datanguoidung[0]['avt']))
                                                                                            echo $datanguoidung[0]['avt'];
                                                                                        else
                                                                                            echo '/public/images/defaultAvt.jpg' ?>' />
                    </div>
                </div>
                <div class="container container-title">
                    <div class='name-user-title'>hahaha haha</div>
                    <div class='content-user'>online gần đây</div>
                </div>
                <div class='menu-title'>
                    <span>
                        <md-icon-button id="usage-anchor">
                            <md-icon>More_Vert</md-icon>
                        </md-icon-button>
                        <md-menu id="usage-menu" anchor="usage-anchor">
                            <md-menu-item>
                                <div slot="headline">Thêm thành viên</div>
                            </md-menu-item>
                            <md-menu-item>
                                <div slot="headline">Rời khỏi nhóm</div>
                            </md-menu-item>
                            <md-menu-item>
                                <div slot="headline">Xoá nhóm</div>
                            </md-menu-item>
                        </md-menu>
                    </span>

                    <script type="module">
                        // This example uses anchor as an ID reference
                        const anchorEl = document.body.querySelector('#usage-anchor');
                        const menuEl = document.body.querySelector('#usage-menu');

                        anchorEl.addEventListener('click', () => {
                            menuEl.open = !menuEl.open;
                        });
                    </script>
                </div>
            </div>
            <div class="chatbox">
                <div class="chatlayout">

                </div>

            </div>
            <div class="chatbox-divider"> <md-divider class='divider-custom chatlayout-divider' inset>
                </md-divider></div>
            </md-divider>
            <div class="user-chat">
                <div class="chatinput">
                    <md-elevation></md-elevation>
                    <textarea id="input-mess" rows="20" maxlength="4000" name="message" placeholder="Nhập tin nhắn của bạn..."></textarea>
                </div>
                <md-filled-button class="sendBtn">
                    Gửi
                    <svg slot="icon" viewBox="0 0 48 48">
                        <path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z" />
                    </svg>
                </md-filled-button>
            </div>
        </div>
        <div class="side-bar-chat">
            <md-elevation></md-elevation>
            <div class="top-side-bar-chat">
                <!-- <div>
                    <md-icon-button class="back_to_mess_icon">
                        <md-icon>Arrow_Back</md-icon>
                    </md-icon-button>
                </div> -->
                <div class='from-user' id="openprofile">
                    <div class='avatar-select avt'>
                        <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                    </div>
                </div>
                <md-outlined-text-field class="search" placeholder="Tìm kiếm tin nhắn">
                    <md-icon slot="leading-icon">search</md-icon>
                </md-outlined-text-field>
            </div>
            <md-divider></md-divider>

            <md-fab lowered size="large" id="fab-new-mess" label="Tin nhắn mới" aria-label="Tin nhắn mới">
                <md-icon slot="icon">edit</md-icon>
            </md-fab>
            <div class='chatlist'>
                <?php
                $count = 0;

                foreach ($mergedMessages as $id => $messages) {
                    $lastMessage = end($messages);
                ?>
                    <div id="chatroom_<?php echo $id ?>" class="item-chat">
                        <md-elevation></md-elevation>
                        <md-ripple></md-ripple>
                        <div class='from-user'>
                            <div class='avatar-select avt'>
                                <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                            </div>
                        </div>
                        <div class="container">
                            <div class='name-user'><?php echo $lastMessage['name'] ?></div>
                            <?php if ($lastMessage['content']) { ?>
                                <div class='content-user'><?php if ($lastMessage['fromMe'] === 1) {
                                                                echo "<strong> Bạn: </strong>";
                                                            } else {
                                                                echo "<strong>" . $lastMessage['sender'] . ": </strong>";
                                                            }
                                                            ?><?php echo $lastMessage['content'] ?></div>
                            <?php } ?>
                        </div>
                        <div class="more">
                            <md-filled-tonal-icon-button id="info_<?php echo $id ?>">
                                <md-icon>More_Horiz</md-icon>
                            </md-filled-tonal-icon-button>
                            <md-menu x-offset="-40" id="menu_chat_item_<?php echo $id ?>" anchor="info_<?php echo $id ?>">
                                <md-menu-item>
                                    <div slot="headline">Xoá</div>
                                </md-menu-item>

                            </md-menu>
                        </div>
                        <script type="module">
                            // This example uses anchor as an ID reference
                            const anchorEl_<?php echo $id ?> = document.body.querySelector('#info_<?php echo $id ?>');
                            const menuEl_<?php echo $id ?> = document.body.querySelector('#menu_chat_item_<?php echo $id ?>');

                            anchorEl_<?php echo $id ?>.addEventListener('click', () => {
                                menuEl_<?php echo $id ?>.open = !menuEl_<?php echo $id ?>.open;
                            });
                        </script>
                    </div>
                    <?php if ($count < count($mergedMessages) - 1) { ?>
                        <md-divider class='divider-custom' inset></md-divider>
                    <?php } ?>
                    <?php $count++; ?>
                <?php } ?>
                <!-- <div class="add-group">
                    <md-elevation></md-elevation>
                    <md-ripple></md-ripple>
                    <h3>
                        + THÊM CUỘC TRÒ CHUYỆN MỚI
                    </h3>
                </div> -->
            </div>
        </div>

    </div>
    <div class="profile-popup">
        <?php

        $viewsDir = DIR . '/app/views';

        require_once($viewsDir . '/component/profile/profile.php');
        require_once($viewsDir . '/component/newroom.php');

        ?>
    </div>

    <md-menu positioning="fixed" id="usage-document" anchor="usage-document-anchor">
        <md-menu-item class="re-mess">
            <div slot="headline">Xoá</div>
        </md-menu-item>

    </md-menu>
</body>



</html>
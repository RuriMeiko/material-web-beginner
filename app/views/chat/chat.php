<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Người dùng</title>
    <link rel="stylesheet" href="/public/css/profile.css" />

    <?php require_once(DIR . '/app/controllers/chat.php');
    ?>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/chat.css" />
    <link rel="stylesheet" href="/public/css/form.css" />
    <script src="/public/js/chat.js"></script>

</head>

<body>
    <div class="chat">

        <div class="chatscrene">
            <div class="title-chat">
                <md-elevation></md-elevation>
                <div class='from-user'>
                    <div class='avatar-select avt avt-title'>
                        <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                    </div>
                </div>
                <div class="container container-title">
                    <div class='name-user-title'>hahaha haha</div>
                    <div class='content-user'>online gần đây</div>
                </div>
            </div>
            <div class="chatbox">
                <div class="chatlayout">
                    <?php for ($i = 0; $i < 10; $i++) { ?>

                        <div class="mess-self">
                            <div class="mess-chat">
                                <div class="content-chat">
                                    <p>chào cậu nhé hôm nay tôi sẽ đi ăn gà rán tại công viên sông hậu trên con đường quen thuộc vào buổi chiều tàn, với ánh nắng nhẹ nhàng, cùng nhau ăn bánh sầu riêng, ehehe</p>
                                    <span class="time-chat">20:00</span>

                                </div>

                                <div class='from-user'>
                                    <div class='avatar-select avt avt-title'>
                                        <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                    <?php for ($i = 0; $i < 10; $i++) { ?>
                        <div class="mess-other have-name">
                            <div class="mess-chat">

                                <div class="content-chat">
                                    <p class="usermessname">hahaha haha</p>

                                    <p>chào cậu nhé hôm nay tôi sẽ đi ăn gà rán tại công viên sông hậu trên con đường quen thuộc vào buổi chiều tàn, với ánh nắng nhẹ nhàng, cùng nhau ăn bánh sầu riêng, ehehe</p>
                                    <span class="time-chat">20:00</span>

                                </div>

                                <div class='from-user'>
                                    <div class='avatar-select avt avt-title'>
                                        <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php } ?>

                    <div class="mess-self">
                        <div class="mess-chat">
                            <div class="content-chat">
                                <p>chào cậu nhé hôm nay tôi sẽ đi ăn gà rán tại công viên sông hậu trên con đường quen thuộc vào buổi chiều tàn, với ánh nắng nhẹ nhàng, cùng nhau ăn bánh sầu riêng, ehehe</p>
                                <span class="time-chat">20:00</span>

                            </div>

                            <div class='from-user'>
                                <div class='avatar-select avt avt-title'>
                                    <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                                </div>
                            </div>

                        </div>
                    </div>
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
            <md-outlined-text-field class="search" placeholder="Search for messages">
                <md-icon slot="leading-icon">search</md-icon>
            </md-outlined-text-field>
            <md-fab lowered size="large" id="fab-new-mess" label="Tin nhắn mới" aria-label="Tin nhắn mới">
                <md-icon slot="icon">edit</md-icon>
            </md-fab>
            <div class='chatlist'>
                <div id="456" class="item-chat">
                    <md-elevation></md-elevation>

                    <md-ripple></md-ripple>
                    <div class='from-user'>
                        <div class='avatar-select avt'>
                            <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                        </div>
                    </div>
                    <div class="container">

                        <div class='name-user'>hahaha haha</div>
                        <div class='content-user'>em oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi day</div>
                    </div>
                </div>

                <md-divider class='divider-custom' inset></md-divider>

                <div id="123" class="item-chat choosed">
                    <md-elevation></md-elevation>

                    <md-ripple></md-ripple>
                    <div class='from-user'>
                        <div class='avatar-select avt'>
                            <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                        </div>
                    </div>
                    <div class="container">

                        <div class='name-user'>hahaha haha</div>
                        <div class='content-user'>em oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi day</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="side-bar">
            <div class='from-user' id="openprofile">
                <div class='avatar-select avt'>
                    <img class="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                </div>
            </div>
        </div>
    </div>
    <div class="profile-popup">
        <?php

        $viewsDir = DIR . '/app/views';

        require_once($viewsDir . '/profile/profile.php');

        ?>
    </div>
</body>



</html>
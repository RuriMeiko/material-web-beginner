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

</head>

<body>
    <div class="chat">
        <div class="chatscrene">

            <div class="chatbox"></div>

            <div class="user-chat">
                <div class="chatinput">
                    <md-elevation></md-elevation>
                    <textarea rows="20" maxlength="4000" name="message" placeholder="Nhập tin nhắn của bạn..."></textarea>
                </div>
                <md-filled-button class="sendBtn">
                    Gửi
                    <svg slot="icon" viewBox="0 0 48 48">
                        <path d="M6 40V8l38 16Zm3-4.65L36.2 24 9 12.5v8.4L21.1 24 9 27Zm0 0V12.5 27Z" />
                    </svg>
                </md-filled-button>
            </div>
        </div>
        <div class="side-bar">
            <md-elevation></md-elevation>
            <a href="/profile">
                <div class='user-info'>
                    <div class="avatar-container">
                        <div class='avatar-select'>

                            <img id="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' ?>" />
                        </div>
                    </div>
                    <h1 id='title'>@rurimeiko</span>
                    </h1>
                </div>
            </a>
            <md-divider class='divider-custom' inset></md-divider>

            <div class='chatlist'>
                <div class="item-chat">
                    <md-elevation></md-elevation>

                    <md-ripple></md-ripple>
                    <div class='from-user'>
                        <div class='avatar-select avt'>
                            <img id="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                        </div>
                    </div>
                    <div class="container">

                        <div class='name-user'>hahaha haha</div>
                        <div class='content-user'>em oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi day</div>
                    </div>




                </div>
                <div class="item-chat choosed">
                    <md-elevation></md-elevation>

                    <md-ripple></md-ripple>
                    <div class='from-user'>
                        <div class='avatar-select avt'>
                            <img id="avatar-preview" class="avatar-preview mb-4" src='/public/images/defaultAvt.jpg' />
                        </div>
                    </div>
                    <div class="container">

                        <div class='name-user'>hahaha haha</div>
                        <div class='content-user'>em oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi dayem oi anh muon di an gi day</div>
                    </div>




                </div>
            </div>
        </div>

    </div>
</body>

</html>
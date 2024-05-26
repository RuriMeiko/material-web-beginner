<script src="/public/js/header.js"></script>
<header class="header">
    <md-elevation></md-elevation>
    <h2 id='title'>Chào <?php echo checkTime() ?><span>@<?php echo $datanguoidung[0]['username'] ?></span> </h2>
    <div class='title-profile'>
        <?php if ($datanguoidung[0]['role'] === 0)
            echo '
        <md-filled-tonal-icon-button id="adminbtn"  href="/admin">
            <md-icon>Admin_Panel_Settings</md-icon>
        </md-filled-tonal-icon-button>' ?>
        <md-filled-tonal-icon-button id="logoutbtn" href="/api/logout">
            <md-icon>logout</md-icon>

        </md-filled-tonal-icon-button>
    </div>
</header>
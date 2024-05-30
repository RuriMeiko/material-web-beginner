<header class="header">
    <md-elevation></md-elevation>
    <?php if (!isset($datanguoidung)) return header('Location: /');
    ?>
    <h1 id='title'>Chào <?php echo checkTime() ?><span>@<?php echo $datanguoidung[0]['username'] ?></span> </h1>
    <div class='btn-list-header'>
        <?php
        if ($datanguoidung[0]['role'] === 0 && str_starts_with($_SERVER['REQUEST_URI'], '/admin'))
            echo '
        <md-filled-tonal-icon-button href="/chat" id="openprofile">
            <md-icon>Forum</md-icon>
        </md-filled-tonal-icon-button>';
        ?>


        <md-filled-tonal-icon-button id="logoutbtn" href="/api/logout">
            <md-icon>logout</md-icon>

        </md-filled-tonal-icon-button>
    </div>
</header>
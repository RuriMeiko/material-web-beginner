<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý bảng đánh giá</title>
    <?php require_once (DIR . '/app/controllers/profile.php');
    ?>
    <?php require_once (DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/header.css" />
    <link rel="stylesheet" href="/public/css/admin.css" />
    <link rel="stylesheet" href="/public/css/statistical.css" />
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="/public/css/nav.css" />

</head>

<body>
    <script>
        const myusername = "<?php echo $datanguoidung[0]['username'] ?>"
    </script>

    <div class="content-right">

        <?php require_once DIR . "/app/views/component/sidebar.php" ?>
        <div class="content-view">
            <?php require_once DIR . "/app/views/component/header.php" ?>


            <div class="box">
                <md-elevation></md-elevation>

                <div class='title-profile'>
                    <h1>Thống kê</h1>
                </div>
                <div class="statistical_wapper">
                    <div class="statistical">
                        <canvas id="statistical"></canvas>
                    </div>
                    <div class="statistical">
                        <canvas id="roomstatistical"></canvas>
                    </div>
                </div>



            </div>
        </div>
    </div>

    <script src="/public/js/statistical.js"></script>
</body>

</html>
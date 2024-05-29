<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Quản lý bảng đánh giá</title>
    <?php require_once(DIR . '/app/controllers/profile.php');
    ?>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/header.css" />
    <link rel="stylesheet" href="/public/css/admin.css" />
    <link rel="stylesheet" href="/public/css/tableManager.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>

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
                    <h1>Quản lý bảng đánh giá</h1>
                </div>
                <div class="scoreManager">

                    <div class='treetieuchi'>

                        <div class="btnlistandtotal">
                            <div class="btnlist">
                                <md-outlined-button id="deltieuchi"><svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000">
                                        <path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z" />
                                    </svg>Xoá tiêu chí</md-outlined-button>
                                <md-filled-button id="addtieuchi"><svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                                        <path d="M440-240h80v-120h120v-80H520v-120h-80v120H320v80h120v120ZM240-80q-33 0-56.5-23.5T160-160v-640q0-33 23.5-56.5T240-880h320l240 240v480q0 33-23.5 56.5T720-80H240Zm280-520v-200H240v640h480v-440H520ZM240-800v200-200 640-640Z" />
                                    </svg>Thêm tiêu chí</md-filled-button>
                            </div>
                            <h3>Tổng điểm: 0</h3>

                        </div>
                        <div id="evaluationTree"> </div>
                    </div>
                    <div class="score">
                        <h1>Chi tiết tiêu chí 1</h1>
                        <div class="chitiet-score">

                            <md-outlined-text-field class="enterscore" label="Điểm" type="number" value="0" prefix-text="💯" suffix-text=".điểm">
                            </md-outlined-text-field>
                            <md-outlined-text-field class="entercritecontent" maxlength="100" type="textarea" label="Nội dung chi tiết" rows="10">>
                            </md-outlined-text-field>
                        </div>
                    </div>
                    <div class="scoreTC">
                        <h1>Chi tiết tiêu chuẩn 1</h1>
                        <div class="chitiet-score">
                            <md-outlined-text-field class="enterChitietcontent" maxlength="20" type="textarea" label="Nội dung chi tiết" rows="10">>
                            </md-outlined-text-field>
                        </div>
                    </div>


                </div>

                <!-- <md-circular-progress indeterminate class='loading'></md-circular-progress> -->
                <div class="btn-box">
                    <md-filled-tonal-button class="toadminbtn">
                        <svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M840-680v480q0 33-23.5 56.5T760-120H200q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h480l160 160Zm-80 34L646-760H200v560h560v-446ZM480-240q50 0 85-35t35-85q0-50-35-85t-85-35q-50 0-85 35t-35 85q0 50 35 85t85 35ZM240-560h360v-160H240v160Zm-40-86v446-560 114Z" />
                        </svg>
                        Lưu
                    </md-filled-tonal-button>
                </div>
            </div>
        </div>
    </div>

    <script src="/public/js/tableManager.js"></script>
</body>

</html>
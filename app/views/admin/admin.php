<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <?php require_once(DIR . '/app/controllers/profile.php');
    ?>
    <?php require_once(DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/header.css" />
    <link rel="stylesheet" href="/public/css/admin.css" />
    <link rel="stylesheet" href="/public/css/nav.css" />

</head>

<body>
    <script>
        const myusername = "<?php echo $datanguoidung[0]['username'] ?>"
    </script>
    <md-dialog id="roleDialog" type="alert">
        <div slot="headline">Confirm change role</div>
        <form slot="content" id="form-id" method="dialog">
            Bạn có chắc chắn chứ?
        </form>
        <div slot="actions">
            <md-text-button form="form-id" value="cancel">Huỷ</md-text-button>
            <md-text-button form="form-id" value="ok">Chơi!</md-text-button>
        </div>
    </md-dialog>
    <div class="content-right">

        <?php require_once DIR . "/app/views/component/sidebar.php" ?>
        <div class="content-view">
            <?php require_once DIR . "/app/views/component/header.php" ?>


            <div class="box">
                <md-elevation></md-elevation>

                <div class='title-profile'>

                    <h1>Quản lý người dùng</h1>

                </div>
                <div class="btn-list">


                    <md-filled-tonal-button id="toadminbtn" class="toadminbtn">
                        <svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="M280-160v-80h400v80H280Zm160-160v-327L336-544l-56-56 200-200 200 200-56 56-104-103v327h-80Z" />
                        </svg>
                        Thêm quyền admin
                    </md-filled-tonal-button>
                    <md-filled-tonal-button id="deleteadmin" class="toadminbtn">


                        <svg slot="icon" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e8eaed">
                            <path d="m396-340 84-84 84 84 56-56-84-84 84-84-56-56-84 84-84-84-56 56 84 84-84 84 56 56Zm84 260q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z" />
                        </svg>
                        Xoá quyền admin
                    </md-filled-tonal-button>
                </div>
                <div class="table-manager">


                    <div class="table-box">
                        <table class="mdc-data-ta ble">
                            <thead>
                                <tr>
                                    <th class="mdc-data-table__header-cell"><md-checkbox class="checkall" value='all' touch-target="wrapper"></md-checkbox></th>

                                    <th class="mdc-data-table__header-cell">
                                        Name
                                    </th>
                                    <th class="mdc-data-table__header-cell">Username</th>
                                    <th class="mdc-data-table__header-cell">Birthdate</th>
                                    <th class="mdc-data-table__header-cell">Gender</th>
                                    <th class="mdc-data-table__header-cell">Location</th>
                                    <th class="mdc-data-table__header-cell">Role</th>
                                    <th class="mdc-data-table__header-cell">Admin</th>
                                </tr>
                            </thead>
                            <tbody id="user_data">
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination">
                        <md-filled-icon-button id="prevBtn" disabled>
                            <md-icon>Navigate_Before</md-icon>
                        </md-filled-icon-button>
                        <div id="pageNumbers">
                            <md-ripple></md-ripple>
                            <p>1</p>
                        </div>
                        <md-filled-icon-button id="nextBtn">
                            <md-icon>Navigate_Next</md-icon>
                        </md-filled-icon-button>
                    </div>
                </div>

                <md-circular-progress indeterminate class='loading'></md-circular-progress>

            </div>
        </div>
    </div>

    <script src="/public/js/admin.js"></script>
</body>

</html>
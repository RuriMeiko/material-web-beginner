<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin</title>
    <?php require_once (DIR . '/app/controllers/profile.php');
    ?>
    <?php require_once (DIR . '/public/styles/styleGlobal.php'); ?>
    <link rel="stylesheet" href="/public/css/admin.css" />

</head>

<body>

    <md-dialog id="roleDialog" type="alert">
        <div slot="headline">Confirm change State</div>
        <form slot="content" id="form-id" method="dialog">
           Hành Động Này Đồng Nghĩa Chặn Toàn Bộ Truy Cập Của User Vào Phòng Chat Bạn có chắc chắn chứ?
        </form>
        <div slot="actions">
            <md-text-button form="form-id" value="cancel">Huỷ</md-text-button>
            <md-text-button form="form-id" value="ok">Chơi!</md-text-button>
        </div>
    </md-dialog>
    <div class="box">
        <div class='title-profile'>

            <h1>Quản lý người dùng</h1>
            <div class='btn-profile'>
                <md-filled-tonal-icon-button href="/chat">
                    <md-icon>Person</md-icon>
                </md-filled-tonal-icon-button>
                <md-filled-tonal-icon-button href="/api/logout">
                    <md-icon>logout</md-icon>
                </md-filled-tonal-icon-button>

            </div>
        </div>
        <table class="mdc-data-table">
            <thead>
                <tr>
                    <th class="mdc-data-table__header-cell">
                    <md-checkbox value='all'touch-target="wrapper"></md-checkbox></th>
                    <th class="mdc-data-table__header-cell">chat room name</th>
                    <th class="mdc-data-table__header-cell">count user</th>
                    <th class="mdc-data-table__header-cell">Current State</th>
                    <th class="mdc-data-table__header-cell">State</th>
                </tr>
            </thead>
            <tbody id="user_data">
            </tbody>
        </table>
        <md-circular-progress indeterminate class='loading'></md-circular-progress>
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
    <script src="/public/js/admin.chatroom.js"></script>
</body>

</html>
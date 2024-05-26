<nav class="navbar">
    <div class="sidebarlogo">
        <h1>Admin</h1>
    </div>
    <a href="/admin/usermanager">
        <div class="item-navbar <?php if ($_SERVER['REQUEST_URI'] === '/admin/usermanager') echo 'choosed' ?>">
            <div class="content-sidebar">
                <md-ripple></md-ripple>
                <md-icon>Group</md-icon> Quản lý người dùng
            </div>
            <div class="sellect"></div>
        </div>
        <a href="/admin/listmanager">
            <div class="item-navbar <?php if ($_SERVER['REQUEST_URI'] === '/admin/listmanager') echo 'choosed' ?>">
                <div class="content-sidebar">
                    <md-ripple></md-ripple>
                    <md-icon>List</md-icon> Quản lý bảng đánh giá
                </div>
                <div class="sellect"></div>
            </div>
        </a>
</nav>
<script src="/public/js/nav.js"></script>
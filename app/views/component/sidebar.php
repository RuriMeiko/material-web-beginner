<nav class="navbar">
    <md-elevation></md-elevation>

    <div class="sidebarlogo">
        <h1>Admin</h1>
    </div>
    <a href="/admin">
        <div class="item-navbar <?php if ($_SERVER['REQUEST_URI'] === '/admin') echo 'choosed' ?>">
            <div class="content-sidebar">
                <md-ripple></md-ripple>
                <md-icon>Group</md-icon> Quản lý người dùng
            </div>
            <div class="sellect"></div>
        </div>
        <a href="/chatroom">
            <div class="item-navbar <?php if ($_SERVER['REQUEST_URI'] === '/chatroom') echo 'choosed' ?>">
                <div class="content-sidebar">
                    <md-ripple></md-ripple>
                    <md-icon>Forum</md-icon> Quản lý phòng chat
                </div>
                <div class="sellect"></div>
            </div>
        </a>
       
</nav>
<script src="/public/js/nav.js"></script>
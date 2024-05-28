<?php
require_once(__DIR__ . '/../config.php');
require_once(DIR . '/router.php');
$viewsDir = DIR . '/app/views';
$controllersDir = DIR . '/app/controllers';

// Handle the request
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$router = new Router('/');

// Add routes
$router->addRoute('GET', '/', function () {
    global $viewsDir;
    require($viewsDir . '/login/login.php');
});

$router->addRoute('GET', '/term', function () {
    global $viewsDir;
    require($viewsDir . '/term/term.php');
});
$router->addRoute('GET', '/fastcheck', function () {
    global $viewsDir;
    require($viewsDir . '/fastcheck/fastcheck.php');
});

$router->addRoute('GET', '/profile', function () {
    global $viewsDir;
    require($viewsDir . '/profile/profile.php');
});

$router->addRoute('GET', '/profile/change_password', function () {
    global $viewsDir;
    require($viewsDir . '/profile/password.php');
});
$router->addRoute('GET', '/admin/usermanager', function () {
    global $viewsDir;
    require_once($viewsDir . '/admin/admin.php');
});
$router->addRoute('GET', '/admin/listmanager', function () {
    global $viewsDir;
    require_once($viewsDir . '/admin/tablemanager.php');
});

$router->addRoute('GET', '/admin/review/{username}', function ($username) {
    global $viewsDir;
    require_once($viewsDir . '/fastcheck/fastcheck.php');
});

// Add API routes
$router->addRoute('GET', '/api/admin/listmanager', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/managerTable.php');
});
$router->addRoute('POST', '/api/admin/listmanager', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/managerTable.php');
});

$router->addRoute('POST', '/api/admin/block', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/block.php');
});

$router->addRoute('POST', '/api/login', function () {
    global $controllersDir;
    require_once($controllersDir . '/login.php');
});

$router->addRoute('POST', '/api/register', function () {
    global $controllersDir;
    require_once($controllersDir . '/register.php');
});

$router->addRoute('POST', '/api/fastcheck', function () {
    global $controllersDir;
    require_once($controllersDir . '/fastcheck.php');
});

$router->addRoute('GET', '/api/logout', function () {
    global $controllersDir;
    require_once($controllersDir . '/logout.php');
});

$router->addRoute('POST', '/api/profile/update', function () {
    global $controllersDir;
    require_once($controllersDir . '/profile.php');
});

$router->addRoute('POST', '/api/admin/getuserdata', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/getUserList.php');
});

$router->addRoute('POST', '/api/admin/changerole', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/changeRole.php');
});

$router->addRoute('POST', '/api/admin/getcount', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/getCount.php');
});


require_once(DIR . '/app/middleware/middleware.php');
// $router->handleRequest($method, $path);
$router->handleRequest($method, $path);

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


$router->addRoute('GET', '/admin', function () {
    global $viewsDir;
    require_once($viewsDir . '/admin/admin.php');
});


$router->addRoute('GET', '/chatroom', function () {
    global $viewsDir;
    require_once($viewsDir . '/admin/chatroom.php');
});






// Add API routes
$router->addRoute('POST', '/api/login', function () {
    global $controllersDir;
    require_once($controllersDir . '/login.php');
});

$router->addRoute('POST', '/api/register', function () {
    global $controllersDir;
    require_once($controllersDir . '/register.php');
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

// chatroom
$router->addRoute('POST', '/api/admin/getallchatroom', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/chatRoom.php');
});
$router->addRoute('POST', '/api/admin/getchatroomcount', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/getCount.chatRoom.php');
});
$router->addRoute('POST', '/api/admin/roomchangestate', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/room.changeState.php');
});




$router->addRoute('POST', '/api/admin/changerole', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/changeRole.php');
});
$router->addRoute('POST', '/api/admin/changestate', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/changeState.php');
});

$router->addRoute('POST', '/api/admin/getcount', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin/getCount.php');
});

$router->addRoute('POST', '/api/createchatroom', function () {
    global $controllersDir;
    require_once($controllersDir . '/chat.php');
});
$router->addRoute('POST', '/api/getaccount', function () {
    global $controllersDir;
    require_once($controllersDir . '/usergetuser.php');
});
$router->addRoute('POST', '/api/addfriend', function () {
    global $controllersDir;
    require_once($controllersDir . '/friend.php');
});

$router->addRoute('POST', '/api/sendmess', function () {
    global $controllersDir;
    require_once($controllersDir . '/message.php');
});

$router->addRoute('POST', '/api/delmess', function () {
    global $controllersDir;
    require_once($controllersDir . '/message.php');
});


require_once(DIR . '/app/middleware/middleware.php');
// $router->handleRequest($method, $path);
$router->handleRequest($method, $path);

<?php
require_once(__DIR__ . '/../config.php');
require_once(DIR . '/router.php');
$viewsDir = DIR . '/app/views';
$controllersDir = DIR . '/app/controllers';

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


$router->addRoute('GET', '/profile', function () {
    global $viewsDir;
    require($viewsDir . '/profile/profile.php');
});

$router->addRoute('GET', '/getuserdata', function () {
    global $viewsDir;
    require_once($viewsDir . '/dataTable/dataTable.php');
});


$router->addRoute('GET', '/scoring', function () {
    global $viewsDir;
    require_once($viewsDir . '/scoring/scoring.php');
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


$router->addRoute('POST', '/api/getuserdata', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin.getUserList.php');
});

$router->addRoute('POST', '/api/changerole', function () {
    global $controllersDir;
    require_once($controllersDir . '/admin.changeRole.php');
});


// Handle the request
$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

// $router->handleRequest($method, $path);
$router->handleRequest($method, $path);

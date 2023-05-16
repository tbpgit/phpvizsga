<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Router.php';

$router = new Router();

$router->addRoute("/", function () {
    require_once("templates/home.php");
});

$router->addRoute("/home", function () {
    require_once("templates/home.php");
});

$router->addRoute("/login", function () {
    require_once("templates/login.php");
});

$router->addRoute("/registration", function () {
    require_once("templates/registration.php");
});

$router->addRoute("/logout", function () {
    require_once("templates/logout.php");
});

$router->addRoute("/update", function () {
    require_once("templates/updateUser.php");
});

$router->addRoute("/userlog", function () {
    require_once("templates/userlog.php");
});

$router->addRoute("/admin", function () {
    require_once("templates/admin/admin.php");
});

$router->addRoute("/userupdate", function () {
    require_once("templates/admin/adminUpdateUser.php");
});

$router->addRoute("/adminlog", function () {
    require_once("templates/admin/adminLog.php");
});

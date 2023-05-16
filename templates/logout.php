<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';

session_destroy();
header('location:/login');
exit();

<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "vegleges";

$dbConnect = new mysqli($server, $user, $password, $db);


$createUserRoleTable =
    "CREATE TABLE role (
R_ID TINYINT(1) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
R_NAME VARCHAR(30) NOT NULL
)";

if ($dbConnect->query($createUserRoleTable)) {
    echo 'user_role tábla sikeresen létrehozva<br/>';
}

$createUserTable =
    "CREATE TABLE user (
U_ID INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
PASSWORD VARCHAR(100) NOT NULL,
EMAIL VARCHAR(50) NOT NULL,
ROLE TINYINT(1) UNSIGNED NOT NULL DEFAULT 2,
ENABLED TINYINT(1) UNSIGNED NOT NULL DEFAULT 1
)";

if ($dbConnect->query($createUserTable)) {
    echo 'user tábla sikeresen létrehozva<br/>';
}

$createUserDataTable =
    "CREATE TABLE user_data (
U_ID INT (10) UNSIGNED PRIMARY KEY,
FIRST_NAME VARCHAR(30) NULL,
LAST_NAME VARCHAR(30) NULL,
PHONE_NUMBER VARCHAR(30) NULL,
FOREIGN KEY (U_ID) REFERENCES user(U_ID)
)";

if ($dbConnect->query($createUserDataTable)) {
    echo 'user_data tábla sikeresen létrehozva<br/>';
}


$createUserPhotoTable =
    "CREATE TABLE user_photo (
ID INT (10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
U_ID INT (10) UNSIGNED NOT NULL,
FILE_NAME VARCHAR(100) NOT NULL
)";

if ($dbConnect->query($createUserPhotoTable)) {
    echo 'user_photo tábla sikeresen létrehozva<br/>';
}


$createLogTable =
    "CREATE TABLE log (
ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
U_ID INT (10) NOT NULL,
TYPE VARCHAR(50) NOT NULL,
MESSAGE VARCHAR(200) NOT NULL,
DATE DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
IP VARCHAR(50) NOT NULL
)";

if ($dbConnect->query($createLogTable)) {
    echo 'log tábla sikeresen létrehozva<br/>';
}

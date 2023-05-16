<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "vegleges";

$dbConnect = new mysqli($server, $user, $password, $db);

$addRole = "INSERT INTO role (R_ID, R_NAME)
             VALUES (1,'Adminisztrátor'), (2, 'Felhasználó')";

$addUser = 'INSERT INTO user (U_ID, PASSWORD, EMAIL, ROLE, ENABLED)
             VALUES (1,"$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK","email@domain.hu",1,1)';

$addUserData = "INSERT INTO user_data (U_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER)
             VALUES (1,'Tóth','Balázs','+36200000000')";

$addUserPhoto = "INSERT INTO user_photo (ID, U_ID, FILE_NAME)
             VALUES ('',1,'default.png')";

$addFirstLog = "INSERT INTO log (ID, U_ID, TYPE, MESSAGE, DATE, IP)
             VALUES ('',1,'registration', 'Admin létrehozva!', NOW(), '127.0.0.1')";


$dbConnect->query($addRole);
$dbConnect->query($addUser);
$dbConnect->query($addUserData);
$dbConnect->query($addUserPhoto);
$dbConnect->query($addFirstLog);

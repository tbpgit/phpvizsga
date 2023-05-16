<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "vegleges";

$dbConnect = new mysqli($server, $user, $password, $db);

$addUser = 'INSERT INTO user (U_ID, PASSWORD, EMAIL, ROLE, ENABLED)
            VALUES 
            (2,"$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK","teszt2@teszt.hu",2,1),
            (3,"$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK","teszt3@teszt.hu",2,1),
            (4,"$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK","teszt4@teszt.hu",2,1),
            (5,"$2y$10$zN9DYJT.bUa43UrpoZqV7OjGGE2BQui1aqvmB.u8.tblPd/kSBDXK","teszt5@teszt.hu",2,1)
            ';

$addUserData = "INSERT INTO user_data (U_ID, FIRST_NAME, LAST_NAME, PHONE_NUMBER)
                VALUES 
                (2,'Richard','Wagner','+36200000000'),
                (3,'Ludwig van','Beethoven','+36200000000'),
                (4,'Franz','Schubert','+36200000000'),
                (5,'Richard','Strauss','+36200000000')
                ";

$addUserPhoto = "INSERT INTO user_photo (ID, U_ID, FILE_NAME)
                 VALUES 
                 ('',2,'deafult.png'),
                 ('',3,'deafult.png'),
                 ('',4,'deafult.png'),
                 ('',5,'deafult.png')
                 ";

$addLog = "INSERT INTO log (ID, U_ID, TYPE, MESSAGE, DATE, IP)
            VALUES 
            ('',2,'registration', '#2 Dummy user létrehozva installból!', NOW(), '127.0.0.1'),
            ('',3,'registration', '#3 Dummy user létrehozva installból!', NOW(), '127.0.0.1'),
            ('',4,'registration', '#4 Dummy user létrehozva installból!', NOW(), '127.0.0.1'),
            ('',5,'registration', '#5 Dummy user létrehozva installból!', NOW(), '127.0.0.1')
            ";



$dbConnect->query($addUser);
$dbConnect->query($addUserData);
$dbConnect->query($addUserPhoto);
$dbConnect->query($addLog);

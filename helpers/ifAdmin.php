<?php

if (isset($_SESSION["u_id"])) {
    $user = new GetUser();
    $userRow = $user->getFullDataById($_SESSION["u_id"]);
    if ($userRow['role'] != '1') {
        unset($user);
        header('location:/home');
        exit();
    }
}

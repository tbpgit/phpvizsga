<?php
//felhasználó adatbázisból való törlése után a session-je megsemmisül
if (isset($_SESSION["u_id"])) {
    $user = new GetUser();
    $userRow = $user->getFullDataById($_SESSION["u_id"]);
    if ($userRow === false) {
        session_destroy();
        header('location:/login');
        exit();
    }
}

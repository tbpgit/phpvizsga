<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';

$user = new GetUser();
$getRole = $user->getFullDataById($_SESSION['u_id']);
$getRole['role']
?>
<div class="sidebar">
    <div class="side-nav">
        <?php if ($getRole['role'] == 1) : ?>
            <div class="nav-element-admin"><a href="/admin">Felhasználók</a></div>
            <div class="nav-element-admin"><a href="/adminlog">Admin log</a></div>
        <?php endif; ?>
        <div class="nav-element"><a href="/">Adatok</a></div>
        <div class="nav-element"><a href="/update">Adatmódosítás</a></div>
        <div class="nav-element"><a href="/userlog">Tevékenységnapló</a></div>
        <div class="nav-element"><a href="/logout">Kijelentkezés</a></div>
    </div>
</div>
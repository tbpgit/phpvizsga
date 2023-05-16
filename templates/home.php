<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';

$u_id = $_SESSION['u_id'];
$user = new GetUser();
$log = new Log();
$userLog = $log->getLoginLogById($u_id);

$userRow = $user->getFullDataById($u_id);

?>
<div class="profile">
    <div class="profile-element">
        <div class="profile-photo">
            <img src="./user_images/<?php echo $userRow['file_name'] ?>" alt="" />
        </div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">Jogosultság:</div>
        <div class="p-element-value"><?php echo $userRow['r_name'] ?></div>
    </div>
    <div class="profile-element">
        <div class="p-element-name-b">Adatok</div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">Név:</div>
        <div class="p-element-value"><?php echo $userRow['first_name'] . " " . $userRow['last_name']  ?></div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">Telefonszám:</div>
        <div class="p-element-value"><?php echo $userRow['email'] ?></div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">Telefonszám:</div>
        <div class="p-element-value"><?php echo $userRow['phone_number'] ?></div>
    </div>
    <div class="profile-element">
        <div class="p-element-name-b">Belépési adatok</div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">IP cím:</div>
        <div class="p-element-value"><?php echo $userLog['ip'] ?></div>
    </div>
    <div class="profile-element">
        <div class="p-element-name">Utolsó belépés</div>
        <div class="p-element-value"><?php echo $userLog['date'] ?></div>
    </div>
</div>
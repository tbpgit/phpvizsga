<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/UpdateUser.php';

$u_id = $_SESSION['u_id'];

$user = new GetUser();
$userRow = $user->getFullDataById($u_id);

$roles = new GetRole();
$allRoles = $roles->getAllRole();

$message = new Message();
$getMessage = $message->getMessage();

$log = new Log();



if (isset($_POST['update'])) {

    if ($_POST['password'] === '') {
        $password = $userRow['password'];
        $password2 = $userRow['password'];
    } else {
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    }
    //a jogosultság az a státusz nem szerkeszthető saját magának
    $role = $userRow['role'];
    $enabled = $userRow['enabled'];

    $update = new UpdateUser(
        $u_id,
        $_POST['email'],
        $password,
        $password2,
        $role,
        $enabled,
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['phonenumber']

    );

    $updateUser = $update->update();
    if ($updateUser !== false) {
        $message->addMessage('Sikeres adatmódosítás!');
        $log->addLog($_SESSION["u_id"], 'update');
        header('location:/update');
        exit();
    }
    $errors = $update->errors();
}

?>
<!--
HTML validálás és input típusok szándékosan kihagyva, hogy a php validálás és visszajelzés tesztelhető legyen
-->
<form class="form" method="post" action="" autocomplete="off">
    <div class="form-message">
        <?php
        if (isset($errors)) {
            echo "<ul><li>" . implode("</li><li>", $errors) . "</li></ul>";
        }
        if (isset($getMessage)) {
            echo $getMessage;
        }
        ?>
    </div>
    <div class="form-title">
        <p>Adatmódosítás</p>
        <p></p>
    </div>
    <div class="form-head">
        <div class="input-element">
            <label for="email">Email: </label>
            <input type="" name="email" id="email" value="<?php echo $userRow['email'] ?>" autocomplete="off" />
        </div>
        <div class="input-element">
            <label for="phonenumber">Telefonszám: </label>
            <input type="" name="phonenumber" id="phonenumber" value="<?php echo $userRow['phone_number'] ?>" />
        </div>
        <div class="input-element">
            <label for="firstname">Vezetéknév: </label>
            <input type="" name="firstname" id="firstname" value="<?php echo $userRow['first_name'] ?>" />
        </div>
        <div class="input-element">
            <label for="lastname">Keresztnév: </label>
            <input type="" name="lastname" id="lastname" value="<?php echo $userRow['last_name'] ?>" />
        </div>
        <div class="input-element">Csak jelszóváltásnál kell kitölteni!</div>
        <div class="input-element">
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" autocomplete="new-password" />
        </div>
        <div class="input-element">
            <label for="password2">Jelszó újra:</label>
            <input type="password" name="password2" id="password2" autocomplete="new-password" />
        </div>
    </div>
    <div class="form-bottom">
        <button class="btn" type="submit" name="update">Adatmódosítás</button>
    </div>
</form>
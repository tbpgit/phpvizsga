<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifAdmin.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/UpdateUser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/DeleteUser.php';

$message = new Message();
$log = new Log();
//GET szűrése külön osztályban - csak int fogadható el, semmilyen más karakter
$getFilter = new GetFilter();
$getVar = $getFilter->getVar();

if (isset($_GET['user'])) {
    $u_id = $getVar;
} else {
    header('location:/admin');
    exit();
}

//Ellenőrzés, hogy a megadott 'u_id'-vel létezik e felhasználó a későbbi hibák elkerülésére
$user = new GetUser();
$userRow = $user->getFullDataById($u_id);
if ($userRow === false) {
    header('location:/admin');
    exit();
}

$roles = new GetRole();
$allRoles = $roles->getAllRole();


$getMessage = $message->getMessage();


if (isset($_POST['update'])) {

    if ($_POST['password'] === '') {
        $password = $userRow['password'];
        $password2 = $userRow['password'];
    } else {
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
    }

    $update = new UpdateUser(
        $u_id,
        $_POST['email'],
        $password,
        $password2,
        $_POST['role'],
        $_POST['enabled'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['phonenumber']

    );

    $updateUser = $update->update();
    if ($updateUser !== false) {
        $message->addMessage('Sikeres adatmódosítás!');
        $log->addLog($_SESSION["u_id"], 'update', "User #{$u_id} admin által módosítva!");
        header("refresh:0");
        exit();
    }
    $errors = $update->errors();
}

if (isset($_POST['delete'])) {

    $deleteUser = new DeleteUser($_POST['deleteid']);
    $deletedId = $deleteUser->checkId();
    $delete = $deleteUser->delete();
    var_dump($delete);

    if ($delete === true) {
        $log->addLog($_SESSION["u_id"], 'delete', "User #{$deletedId} admin által törölve!");
        $message->addMessage('Felhasználó törölve!');
        header("location:/admin");
        exit();
    } else {
        $message->addMessage('Nem sikerült a törlés!');
        header("refresh:0");
    }
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
        <div class="input-element">
            <label for="role">Jogosultság: </label>

            <select name="role" id="role">
                <?php
                foreach ($roles->getAllRole() as $value) {
                    if ($value == $userRow['role']) {
                        echo "<option value='{$value}' selected='selected'>{$roles->getRoleNameById($value)}</option>";
                    } else {
                        echo "<option value='{$value}'>{$roles->getRoleNameById($value)}</option>";
                    }
                }
                ?>
            </select>
        </div>
        <div class="input-element">
            <label>Engedélyezett: </label>
            <label for="enabled1">Igen</label>
            <input <?php if ($userRow['enabled'] == 1) : ?> checked <?php endif; ?> type="radio" id="enabled1" name="enabled" value="1">
            <label for="enabled2">Nem</label>
            <input <?php if ($userRow['enabled'] == 0) : ?> checked <?php endif; ?> type="radio" id="enabled2" name="enabled" value="0">
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

<form class="form" method="post" action="">
    <div class="form-title">
        <p></p>
        <p>Felhasználó törlése</p>
    </div>
    <div class="form-head">
        <div class="input-element-red">
            <label for="delete">Felhasználó törlése: </label>
            <input type="checkbox" id="delete" name="deleteid" value="<?php echo $u_id ?>">
        </div>
        <div class="form-bottom">
            <button class="btn-red" type="submit" name="delete">Végleges törlés</button>
        </div>
</form>
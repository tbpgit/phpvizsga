<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifLoggedIn.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Login.php';
$message = new Message;
$getMessage = $message->getMessage();


if (isset($_POST['login'])) {


    $login = new Login($_POST['password'], $_POST['email']);

    if ($login->signIn() !== false) {
        header('location:/home');
    }
    $errors = $login->errors();
}

?>
<!--
HTML validálás és input típusok szándékosan kihagyva, hogy a php validálás és visszajelzés tesztelhető legyen
-->
<form class="form" method="post" action="/login">
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
        <p>Szimpla Felhasználó Kezelő v0.1</p>
        <p>Bejelentkezés</p>
    </div>
    <div class="form-head">
        <div class="input-element">
            <label for="email">Email: </label>
            <input type="" name="email" id="email" />
        </div>
        <div class="input-element">
            <label for="password">Jelszó:</label>
            <input type="password" name="password" id="password" />
        </div>
    </div>
    <div class="form-bottom">
        <button class="btn" type="submit" name="login">Bejelentkezés</button>
        <small>vagy</small>
        <a href="/registration">Regisztráció</a>
    </div>
</form>
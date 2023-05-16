<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifLoggedIn.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Registration.php';

if (isset($_POST['registration'])) {

    $newMessage = new Message();

    $registration = new Registration(
        $_POST['email'],
        $_POST['password'],
        $_POST['password2'],
        $_POST['firstname'],
        $_POST['lastname'],
        $_POST['phonenumber']
    );

    $signUp = $registration->signUp();
    if ($signUp !== false) {
        $newMessage->addMessage('Regisztiáció sikeres! Jelentkezz be!');
        header('location:/login');
    }
    $errors = $registration->errors();
}

?>
<!--
HTML validálás és input típusok szándékosan kihagyva, hogy a php validálás és visszajelzés tesztelhető legyen
-->
<form class="form" method="post" action="/registration" autocomplete="off">
    <div class="form-message">
        <?php
        if (isset($errors)) {
            echo "<ul><li>" . implode("</li><li>", $errors) . "</li></ul>";
        }
        ?>
    </div>
    <div class="form-title">
        <p>Szimpla Felhasználó Kezelő v0.1</p>
        <p>Regisztráció</p>
    </div>
    <div class="form-head">
        <div class="input-element">
            <label for="firstname">Vezetéknév:* </label>
            <input type="" name="firstname" id="firstname" />
        </div>
        <div class="input-element">
            <label for="lastname">Keresztnév:* </label>
            <input type="" name="lastname" id="lastname" />
        </div>
        <div class="input-element">
            <label for="phonenumber">Telefonszám:* </label>
            <input type="" name="phonenumber" id="phonenumber" placeholder="+36000000000" />
        </div>
        <div class="input-element">
            <label for="email">Email:* </label>
            <input type="" name="email" id="email" />
        </div>
        <div class="input-element">
            <label for="password">Jelszó:*</label>
            <input type="password" name="password" id="password" />
        </div>
        <div class="input-element">
            <label for="password2">Jelszó újra:*</label>
            <input type="password" name="password2" id="password2" />
        </div>
    </div>
    <div class="form-bottom">
        <button class="btn" type="submit" name="registration">Regisztráció</button>
        <small>vagy</small>
        <a href="/login">Bejelentkezés</a>
    </div>
</form>
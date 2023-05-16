<?php
# bejelentkezés után tiltott oldalakra kell beszúrni
# pl.: login
# ha be van jelentkezve, ezek az oldalak nem láthatóak, './home' oldalra irányít át

if (isset($_SESSION["u_id"])) {
    header('location:/home');
    exit();
}

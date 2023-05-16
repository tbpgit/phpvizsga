<?php
# bejelentkezés nélkül tiltott oldalakra kell beszúrni
# pl.:home,logout
# ha olyan oldalt keres fel ami csak bejelentkezés után érhető el '/login' oldalra irányít át

if (!isset($_SESSION['u_id']) || $_SESSION['u_id'] == '') {
    header('location:/login');
    exit();
}

<?php
# direkt hozzáférés megtagadása
# csak az index.php-ból lehet meghívni a fájlokat

if (basename($_SERVER['PHP_SELF']) !== 'index.php') {
    header("refresh:1; url=/home");
    die('Nem!');
}

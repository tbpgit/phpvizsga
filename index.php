<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/DbConnect.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/config/routes.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/GetUser.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/GetRole.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Log.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/Message.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/GetFilter.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/killSession.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
    <link rel="stylesheet" href="/assets/style.css" />
    <title>Felhasználó kezelő</title>
</head>

<body>
    <div id="container">
        <?php if (isset($_SESSION['u_id']))
            require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/sidebar.php';
        ?>
        <div class="content">
            <?php $router->route($_SERVER['REQUEST_URI']); ?>
        </div>
    </div>
</body>

</html>
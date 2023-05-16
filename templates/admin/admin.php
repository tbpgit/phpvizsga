<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifAdmin.php';

$user = new GetUser();
$allUser = $user->getFullData();

$message = new Message();
$getMessage = $message->getMessage();

if (isset($getMessage)) {
    echo $getMessage;
}
?>

<div class="table-container">
    <div class="table-title">
        <p></p>
        <p>Összes felhasználó</p>
    </div>
    <table>
        <thead>
            <tr>
                <th></th>
                <th>Név</th>
                <th>Email</th>
                <th>Jogosultság</th>
                <th>Státusz</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($i < count($allUser)) {
                echo "<tr>";


                echo "<td>";
                echo "<a href='/userupdate?user=" . $allUser[$i]['u_id'] . "'>Profil</a>";
                echo "</td>";

                echo "<td>";
                echo $allUser[$i]['first_name'] . " " . $allUser[$i]['last_name'];
                echo "</td>";

                echo "<td>";
                echo $allUser[$i]['email'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $allUser[$i]['r_name'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $allUser[$i]['enabled'] ? 'Engedélyezett' : 'Letiltott';
                echo "</td>";

                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
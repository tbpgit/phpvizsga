<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifAdmin.php';


$log = new Log();
$getAll = $log->getAllLog();
$logType = $log->logTypes();

$user = new GetUser();

?>
<div class="table-container">
    <div class="table-title">
        <p></p>
        <p>Legutóbbi tevékenységek</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>User ID</th>
                <th>Név</th>
                <th>Jogosulság</th>
                <th>Tevékenység</th>
                <th>Megjegyzés</th>
                <th>IP</th>
                <th>Dátum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($i < count($getAll)) {
                $getUser = $user->getFullDataById($getAll[$i]['u_id']);
                echo "<tr>";


                echo "<td>";
                echo "<a href='/userupdate?user=" . $getAll[$i]['u_id'] . "'>" . $getAll[$i]['u_id'] ?? '' . "</a>";
                echo "</td>";

                echo "<td>";
                echo $getUser['first_name'] ?? '';
                echo " ";
                echo $getUser['last_name'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $getUser['r_name'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $logType[$getAll[$i]['type']] ?? '';
                echo "</td>";

                echo "<td>";
                echo $getAll[$i]['message'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $getAll[$i]['ip'] ?? '';
                echo "</td>";

                echo "<td>";
                echo $getAll[$i]['date'] ?? '';
                echo "</td>";


                echo "</tr>";
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
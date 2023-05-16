<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/noDirectAccess.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/helpers/ifNotLoggedIn.php';
$uid = $_SESSION['u_id'];

$log = new Log();
$getAll = $log->getAllLogById($uid);
$logType = $log->logTypes();

?>
<div class="table-container">
    <div class="table-title">
        <p></p>
        <p>Legutóbbi tevékenységek</p>
    </div>
    <table>
        <thead>
            <tr>
                <th>Tevékenység</th>
                <th>IP</th>
                <th>Dátum</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 0;
            while ($i < count($getAll)) {

                echo "<tr>";


                echo "<td>";
                echo $logType[$getAll[$i]['type']] ?? '';
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
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/classes/DbConnect.php';
/**
 * log típusok:
 * login
 * registration
 * update
 * delete
 * 
 */
class Log extends DbConnect
{
    public function __construct()
    {
        parent::__construct();
    }

    public function logTypes()
    {
        //ez adatbázisban is tárolható lenne
        $logTypes = array('login' => 'Bejelentkezés', 'registration' => 'Regisztráció', 'update' => 'Adatmódosítás', 'delete' => "Törlés");

        return $logTypes;
    }

    public function addLog($id, $type, $message = '')
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $sql = "INSERT INTO log (u_id, type, message, date, ip) 
                 VALUES ('{$id}', '{$type}', '{$message}', NOW(), '{$ip}')";
        $this->getMysqli()->query($sql);
    }


    public function getAllLog()
    {
        $sql = "SELECT u_id, type, message, date, ip FROM log ORDER BY DATE DESC LIMIT 10";
        $query = $this->getMysqli()->query($sql);
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getAllLogById($u_id)
    {
        $sql = "SELECT u_id, type, message, date, ip FROM log WHERE u_id = '{$u_id}' ORDER BY DATE DESC LIMIT 10";
        $query = $this->getMysqli()->query($sql);
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    public function getLoginLogById($u_id)
    {
        $sql = "SELECT  date, ip FROM log WHERE u_id = '{$u_id}' AND type = 'login' ORDER BY DATE DESC LIMIT 1";
        $query = $this->getMysqli()->query($sql);
        $row = $query->fetch_assoc();
        return $row;
    }
}

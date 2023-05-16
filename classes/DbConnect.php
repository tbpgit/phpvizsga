<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/config/dbConfig.php';

class DbConnect
{
    private $connection;

    public function __construct()
    {
        global $server, $username, $password, $database;
        if (!isset($this->connection)) {

            $this->connection = new mysqli($server, $username, $password, $database);

            if (!$this->connection) {
                echo 'Cannot connect to database server';
                exit;
            }
        }

        //return $this->connection;
    }
    public function getMysqli()
    {
        return $this->connection;
    }
}

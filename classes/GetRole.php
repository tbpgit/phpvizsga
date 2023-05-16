<?php
class GetRole extends DbConnect
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getAllRole()
    {
        $sql = "SELECT r_id FROM role";
        $query = $this->getMysqli()->query($sql);
        while ($row = $query->fetch_assoc()) {
            $roles[] = $row['r_id'];
        }
        return $roles;
    }

    public function getRoleNameById($r_id)
    {
        $sql = "SELECT r_name FROM role WHERE r_id = '{$r_id}'";
        $query = $this->getMysqli()->query($sql);
        $row = $query->fetch_assoc();
        return $row['r_name'];
    }
}

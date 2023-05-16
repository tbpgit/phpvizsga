<?php
class GetUser extends DbConnect
{
    //private $id;

    public function __construct()
    {

        parent::__construct();
    }

    private function getAllUser($id)
    {
        $sql = "SELECT u_id FROM user WHERE u_id = '{$id}'";
        $query = $this->getMysqli()->query($sql);
        $row = $query->fetch_assoc();
        $numRows = $this->getMysqli()->affected_rows;
        if ($numRows > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function getFullDataById(int $id)
    {
        if ($this->getAllUser($id) === true) {

            $sql = "SELECT user.u_id, user.password, user.email, user.role, user.enabled,
                        user_data.u_id, user_data.first_name, user_data.last_name, user_data.phone_number,
                        user_photo.u_id, user_photo.file_name,
                        role.r_name
                FROM user
                JOIN user_data ON (user_data.u_id = user.u_id)
                JOIN user_photo ON (user_photo.u_id = user.u_id)
                JOIN role ON (role.r_id = user.role)
                WHERE user.u_id = '{$id}'";
            $query = $this->getMysqli()->query($sql);
            $row = $query->fetch_assoc();
            return $row;
        } else {
            return false;
        }
    }
    public function getFullData()
    {

        $sql = "SELECT user.u_id, user.email, user.role, user.enabled, 
        user_data.first_name, user_data.last_name, user_data.phone_number,
        role.r_name
        FROM user
        JOIN user_data ON (user.u_id = user_data.u_id)
        JOIN role ON(role.r_id = user.role)
        ";
        $query = $this->getMysqli()->query($sql);
        while ($row = $query->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }
}

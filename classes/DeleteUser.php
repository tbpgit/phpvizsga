<?php

class DeleteUser extends DbConnect
{
    public $id;

    public function __construct($id)
    {
        $this->id = $id;
        parent::__construct();
    }

    public function checkId()
    {
        $this->id  = filter_var($this->id, FILTER_VALIDATE_INT);

        return $this->id;
    }
    public function deleteAllRow()
    {

        $sqlUserData = "DELETE FROM user_data WHERE u_id = '{$this->id}'";
        $this->getMysqli()->query($sqlUserData);

        $sqlUserPhoto = "DELETE FROM user_photo WHERE u_id = '{$this->id}'";
        $this->getMysqli()->query($sqlUserPhoto);

        $sqlLog = "DELETE FROM log WHERE u_id = '{$this->id}'";
        $this->getMysqli()->query($sqlLog);

        $sqlUser = "DELETE FROM user WHERE u_id = '{$this->id}'";
        $this->getMysqli()->query($sqlUser);
    }

    public function delete()
    {

        if ($this->checkId() !== false) {
            $this->deleteAllRow();
            return true;
        } else {
            return false;
        }
    }
}

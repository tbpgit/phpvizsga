<?php
class Login extends DbConnect
{

    private $password;
    private $email;
    //  private $query;
    private $row;
    public $errors = array();

    public function __construct($password, $email)
    {
        parent::__construct();

        $this->password = $password;
        $this->email = $this->getMysqli()->real_escape_string($email);


        $sql = "SELECT u_id, password, email, enabled, role FROM user WHERE email = '{$this->email}'";
        $query = $this->getMysqli()->query($sql);
        $this->row = $query->fetch_assoc();
    }

    private function checkInput(): bool
    {

        $errorMessage = array(
            'password' => 'Jelszó mező üres!',
            'email' => 'Helytelen email formátum!'
        );

        $data = array(
            'password' => $this->password,
            'email' => $this->email
        );

        $filter = array(
            'password' => array(
                'filter' => FILTER_CALLBACK,
                'options' => function () {
                    return !empty($this->password);
                }
            ),

            'email' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9\.\_\-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9\.\-]{2,10}$/'
                )
            )
        );

        $filtered = filter_var_array($data, $filter);

        foreach ($filtered as $key => $value) {
            if ($value === false) {
                $this->errors[] = $errorMessage[$key];
            }
        }

        if (empty($this->errors)) {
            return true;
        } else {
            return false;
        }
    }

    private function checkEmail(): bool
    {
        $numRows = $this->getMysqli()->affected_rows;
        if ($numRows > 0) {
            return true;
        } else {
            $this->errors[] = 'Nincs fiók ezzel az email címmel!';
            return false;
        }
    }

    private function checkPass(): bool
    {
        if (password_verify($this->password, $this->row['password'])) {
            return true;
        } else {
            $this->errors[] = 'Hibás jelszó!';
            return false;
        }
    }

    private function checkEnabled(): bool
    {

        if ($this->row['enabled'] !== '0') {
            return true;
        } else {
            $this->errors[] = 'Fiók inaktiválva!';
            return false;
        }
    }

    /* private function addLoginData(): void
    {
        $ip = $_SERVER['REMOTE_ADDR'];

        $loginLog = new Log();
        $loginLog->addLoginLog($this->row['u_id'], $ip);
    }*/
    private function log($id, $type, $message = ''): void
    {
        $loginLog = new Log();
        $loginLog->addLog($id, $type, $message);
    }

    public function errors(): array
    {
        return $this->errors;
    }

    public function signIn()
    {

        if ($this->checkInput() === true && $this->checkEmail() === true) {
            if ($this->checkPass() === true && $this->checkEnabled() === true) {
                $_SESSION['u_id'] = $this->row['u_id'];
                $this->log($this->row['u_id'], 'login');
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

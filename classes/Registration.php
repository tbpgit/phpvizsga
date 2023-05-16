<?php
class Registration extends DbConnect
{
    private $email;
    private $password;
    private $password2;
    private $firstname;
    private $lastname;
    private $phonenumber;
    public $errors = array();

    public function __construct($email, $password, $password2, $firstname, $lastname, $phonenumber)
    {
        parent::__construct();

        $this->email = $email;
        $this->password = trim($password);
        $this->password2 = trim($password2);
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phonenumber = $phonenumber;
    }

    private function checkInput(): bool
    {

        $errorMessage = array(
            'email' => 'Helytelen email formátum!',
            'password' => 'Jelszó hossza 8 és 100 karakter közt legyen!',
            'password2' => 'A két beírt jelszó nem egyezik!'
        );
        $data = array(
            'email' => $this->email,
            'password' => $this->password,
            'password2' => $this->password2
        );
        #FILTER_VALIDATE_EMAIL egy rakás szar
        $filter = array(
            'email' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[a-zA-Z0-9\.\_\-]+@[a-zA-Z0-9]+\.[a-zA-Z0-9\.\-]{2,10}$/'
                )
            ),

            'password' => array(
                'filter' => FILTER_CALLBACK,
                'options' => function () {
                    return strlen($this->password) >= 8 && strlen($this->password) <= 100 ?: false;
                },
            ),

            'password2' => array(
                'filter' => FILTER_CALLBACK,
                'options' => function () {
                    return $this->password == $this->password2 ?: false;
                }
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

    public function checkEmpty(): bool
    {
        $emptyError = array(
            'email' => 'Hiba! Email megadása kötelező!',
            'password' => 'Hiba! Jelszó megadása kötelező!',
            'password2' => 'Hiba! Minden jelszó mező kitöltése kötelező!',
            'firstname' => 'Hiba! Vezetéknév megadása kötelező!',
            'lastname' => 'Hiba! Keresztnév megadása kötelező!',
            'phonenumber' => 'Hiba! Telefonszám megadása kötelező!'
        );

        $requiredData = array(
            'email' => $this->email,
            'password' => $this->password,
            'password2' => $this->password2,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phonenumber' => $this->phonenumber

        );

        foreach ($requiredData as $key => $value) {
            if ($value === '') {
                $this->errors[] = $emptyError[$key];
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
        $sql = "SELECT u_id, password, email FROM user WHERE email = '{$this->email}'";
        $this->getMysqli()->query($sql);
        $numRows = $this->getMysqli()->affected_rows;

        if ($numRows == 0) {
            return true;
        } else {
            $this->errors[] = "Ez az email cím már használatban van!";
            return false;
        }
    }

    private function log($id, $type, $message = ''): void
    {
        $loginLog = new Log();
        $loginLog->addLog($id, $type, $message);
    }

    private function registration(): void
    {
        $hashedPassword = password_hash($this->password, PASSWORD_DEFAULT);

        $sqlUser = "INSERT INTO user (u_id, password, email, role, enabled) 
                    VALUES ('','{$hashedPassword}','{$this->email}','2','1')";
        $this->getMysqli()->query($sqlUser);
        $lastId = $this->getMysqli()->insert_id;

        $sqlUserData = "INSERT INTO user_data (u_id, first_name, last_name, phone_number)
                        VALUES('{$lastId}', '{$this->firstname}', '{$this->lastname}', '{$this->phonenumber}')";
        $this->getMysqli()->query($sqlUserData);

        $sqlUserPhoto = "INSERT INTO user_photo (id, u_id, file_name) 
                         VALUES ('', '$lastId', 'default.png')";
        $this->getMysqli()->query($sqlUserPhoto);

        $this->log($lastId, 'registration');
    }


    public function errors(): array
    {
        return $this->errors;
    }

    public function signUp()
    {
        $checkInput = $this->checkInput();
        $checkEmail = $this->checkEmail();
        $checkEmpty = $this->checkEmpty();
        if ($checkEmpty === true) {
            if ($checkInput === true && $checkEmail === true) {
                $this->registration();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

<?php
// error osztályt kéne csinálni
class UpdateUser extends DbConnect
{
    private $u_id;
    private $email;
    private $password;
    private $password2;
    private $role;
    private $enabled;
    private $firstname;
    private $lastname;
    private $phonenumber;

    public $errors = array();


    public function __construct($u_id, $email, $password, $password2, $role, $enabled, $firstname, $lastname, $phonenumber)
    {
        $this->u_id = $u_id;
        $this->email = $email;
        $this->password = trim($password);
        $this->password2 = trim($password2);
        $this->role = $role;
        $this->enabled = $enabled;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->phonenumber = $phonenumber;

        parent::__construct();
    }

    private function getRole()
    {
        $role = new GetRole();
        return $role->getAllRole();
    }

    // másik felhasználó használja e a küldött emailt?
    private function checkEmail()
    {
        $sql = "SELECT u_id, password, email FROM user WHERE email = '{$this->email}' AND u_id != '{$this->u_id}'";
        $this->getMysqli()->query($sql);

        $numRows = $this->getMysqli()->affected_rows;

        if ($numRows == 0) {
            return true;
        } else {
            $this->errors[] = "Ez az email cím már használatban van!";
            return false;
        }
    }


    public function checkEmpty()
    {
        //jelszavak lehetnek üresek, mert üresnél az eredeti jelszót kapja vissza, nincsen változtatás

        $emptyError = array(
            'email' => 'Hiba! Email megadása kötelező!',
            'role' => 'Hiba! Jogosultság megadása kötelező!',
            'enabled' => 'Hiba! Státusz megadása kötelező!',
            'firstname' => 'Hiba! Vezetéknév megadása kötelező!',
            'lastname' => 'Hiba! Keresztnév megadása kötelező!',
            'phonenumber' => 'Hiba! Telefonszám megadása kötelező!'
        );

        $requiredData = array(
            'email' => $this->email,
            'role' => $this->role,
            'enabled' => $this->enabled,
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
    public function checkUser()
    {


        $errorMessage = array(
            'email' => 'Helytelen email formátum!',
            'password' => 'Jelszó hossza 8 és 100 karakter közt legyen!',
            'password2' => 'A két beírt jelszó nem egyezik!',
            'role' => 'Nincs ilyen jogosultság!',
            'enabled' => 'Hiba az állapot megadásánál!',
            'firstname' => 'Vezetéknév csak betű, pont, kötőjel!',
            'lastname' => 'Keresztnév csak betű, kötőjel!',
            'phonenumber' => 'Rossz telefonszám formátum! Nemzetközi formátum!'
        );
        $data = array(
            'email' => $this->email,
            'password' => $this->password,
            'password2' => $this->password2,
            'role' => $this->role,
            'enabled' => $this->enabled,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'phonenumber' => $this->phonenumber

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
            ),

            'role' => array(
                'filter' => FILTER_CALLBACK,
                'options' => function () {
                    return in_array($this->role, $this->getRole());
                }
            ),

            'enabled' => array(
                'filter' => FILTER_VALIDATE_INT,
                'options' => array("min_range" => 0, "max_range" => 1)
            ),

            'firstname' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ\.\-\s]{2,50}$/'
                ),
            ),

            'lastname' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[a-zA-ZöüóőúéáűíÖÜÓŐÚÉÁŰÍ\-\s]{2,50}$/'
                ),
            ),
            // 11 karakter, kezdő karakter +, +00000000000
            'phonenumber' => array(
                'filter' => FILTER_VALIDATE_REGEXP,
                'options' => array(
                    'regexp' => '/^[\+]+([\d]{10,11})$/'
                ),
            ),
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

    public function updateUserData()
    {
        $sqlUserData = "UPDATE user_data SET 
                            first_name = '{$this->firstname}',
                            last_name = '{$this->lastname}',
                            phone_number = '{$this->phonenumber}'
                            WHERE u_id = '{$this->u_id}'
                            ";
        $this->getMysqli()->query($sqlUserData);
    }

    public function checkUserPhoto()
    {
    }

    public function updateUser()
    {
        $sqlUser = "UPDATE user SET 
                        password = '{$this->password}',
                        email = '{$this->email}',
                        role = '{$this->role}',
                        enabled = '{$this->enabled}'
                        WHERE u_id = '{$this->u_id}'
                        ";
        $this->getMysqli()->query($sqlUser);
    }

    /*private function log($id, $type, $message = ''): void
    {
        $loginLog = new Log();
        $loginLog->addLog($id, $type, $message);
    }*/


    public function update()
    {
        if ($this->checkEmpty() === true) {
            if ($this->checkUser() === true && $this->checkEmail() === true) {

                $this->updateUser();
                $this->updateUserData();
                // $this->log($this->u_id, 'update');
            } else {
                //error message
                return false;
            }
        } else {
            return false;
        }
    }


    public function errors(): array
    {
        return $this->errors;
    }
}

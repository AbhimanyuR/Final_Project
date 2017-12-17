<?php

final class account extends \database\model
{
    public $id;
    public $email;
    public $fname;
    public $lname;
    public $phone;
    public $birthday;
    public $gender;
    public $password;
    protected static $modelName = 'account';

    public static function getTablename()
    {

        $tableName = 'accounts';
        return $tableName;
    }


    public static function findTasks()
    {

        $records = todos::findAll();
        print_r($records);
        return $records;
    }


    public function setPassword($password) {

        $password = password_hash($password, PASSWORD_DEFAULT);
        
        return $password;

    }

    public function checkPassword($LoginPassword) {

        return password_verify($LoginPassword, $this->password);


    }


    public function validate()
    {

        $valid = TRUE;
        $validationErrors = array();
        if (isset($this->email) && ($this->email == '' || !filter_var($this->email, FILTER_VALIDATE_EMAIL)) ) {
            $valid = FALSE;
            $validationErrors[] = 'Please enter a valid Email';
        }

        if (isset($this->fname) && $this->fname == '' ) {
            $valid = FALSE;
            $validationErrors[] = 'Please enter first name';
        }
        if (isset($this->lname) && $this->lname == '' ) {
            $valid = FALSE;
            $validationErrors[] = 'Please enter Last name';
        }

        if (isset($this->password) && ($this->password == '' || (strlen($this->password) < 6)) ) {
            $valid = FALSE;
            $validationErrors[] = 'Password should be at least 6 character long';
        }



        if($valid) {
            return FALSE;
        }else{
            return $validationErrors;
        }

    }



}


?>

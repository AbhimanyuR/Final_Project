<?php


class accountsController extends http\controller
{

    public static function show()
    {

        session_start();
        if(key_exists('userID',$_SESSION)) {
            $userID = $_SESSION['userID'];
            $record = accounts::findOne($userID);
            self::getTemplate('show_account', $record);
       } else {
           echo 'you must be logged in to view accounts';
       }
    }


    public static function all()
    {

        $records = accounts::findAll();
        self::getTemplate('all_accounts', $records);

    }



    public static function register()
    {

        self::getTemplate('register');
    }


    public static function store()

    {
        $user = accounts::findUserbyEmail($_REQUEST['email'].'kjhgfdsfcghjkhgfcghjhhgfcgh');


        if ($user == FALSE) {
            $user = new account();
            $user->email = $_POST['email'];
            $user->fname = $_POST['fname'];
            $user->lname = $_POST['lname'];
            $user->phone = $_POST['phone'];
            $user->birthday = $_POST['birthday'];
            $user->gender = $_POST['gender'];
            $user->password = $user->setPassword($_POST['password']);

            $validationError = $user->validate();
            if (!$validationError) {
                $user->save();
                header("Location: index.php?page=accounts&action=login");
            }else{
                self::getTemplate('register', $validationError);
            }


        } else {

            $error = 'already registered';
            self::getTemplate('error', $error);

        }

    }

    public static function edit()
    {


        session_start();
        if(key_exists('userID',$_SESSION)) {
            $userID = $_SESSION['userID'];
            $record = accounts::findOne($userID);
            self::getTemplate('edit_account', $record);
       } else {
           echo 'you must be logged in to edit';
       }


    }

    public static function save() {
        session_start();
        $userID = $_SESSION['userID'];
        $user = accounts::findOne($userID);

        $user->email = $_POST['email'];
        $user->fname = $_POST['fname'];
        $user->lname = $_POST['lname'];
        $user->phone = $_POST['phone'];
        $user->birthday = $_POST['birthday'];
        $user->gender = $_POST['gender'];

        $validationError = $user->validate();
        if (!$validationError) {
            $user->save();
            header("Location: index.php?page=accounts&action=show");
        }else{
            $user->errors = $validationError;
            self::getTemplate('edit_account', $user);
        }

    }

    public static function delete() {

        $record = accounts::findOne($_REQUEST['id']);
        $record->delete();
        header("Location: index.php?page=accounts&action=all");
    }
    public static function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?page=accounts&action=login");
    }


    public static function login()
    {

        $user = accounts::findUserbyEmail($_REQUEST['email']);


        if ($user == FALSE) {
            $error = 'user not found';
            self::getTemplate('error', $error);
        } else {

            if($user->checkPassword($_POST['password']) == TRUE) {

                session_start();
                $_SESSION["userID"] = $user->id;

                header("Location: index.php?page=tasks&action=all");
            } else {
                $error = 'password does not match';
                self::getTemplate('error', $error);
            }

        }




    }

    public static function loginform()
    {
        $data = '';
        self::getTemplate('login_form', $data);
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: kwilliams
 * Date: 11/27/17
 * Time: 5:32 PM
 */


//each page extends controller and the index.php?page=tasks causes the controller to be called
class accountsController extends http\controller
{

    //each method in the controller is named an action.
    //to call the show function the url is index.php?page=account&action=show
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

    //to call the show function the url is index.php?page=accounts&action=all

    public static function all()
    {

        $records = accounts::findAll();
        self::getTemplate('all_accounts', $records);

    }


    //you should check the notes on the project posted in moodle for how to use active record here

    //this is to register an account i.e. insert a new account
    public static function register()
    {
        //https://www.sitepoint.com/why-you-should-use-bcrypt-to-hash-stored-passwords/
        //USE THE ABOVE TO SEE HOW TO USE Bcrypt
        self::getTemplate('register');
    }

    //this is the function to save the user the new user for registration
    public static function store()

    {
        $user = accounts::findUserbyEmail($_REQUEST['email']);


        if ($user == FALSE) {
            $user = new account();
            $user->email = $_POST['email'];
            $user->fname = $_POST['fname'];
            $user->lname = $_POST['lname'];
            $user->phone = $_POST['phone'];
            $user->birthday = $_POST['birthday'];
            $user->gender = $_POST['gender'];
            //$user->password = $_POST['password'];
            //this creates the password
            //this is a mistake you can fix...
            //Turn the set password function into a static method on a utility class.
            $user->password = $user->setPassword($_POST['password']);
            $user->save();

            //you may want to send the person to a
            // login page or create a session and log them in
            // and then send them to the task list page and a link to create tasks
            header("Location: index.php?page=tasks&action=all");

        } else {
            //You can make a template for errors called error.php
            // and load the template here with the error you want to show.
            // echo 'already registered';
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
//this is used to save the update form data
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
        $user->save();
        header("Location: index.php?page=accounts&action=show");

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

    //this is to login, here is where you find the account and allow login or deny.
    public static function login()
    {
        //you will need to fix this so we can find users username.  YOu should add this method findUser to the accounts collection
        //when you add the method you need to look at my find one, you need to return the user object.
        //then you need to check the password and create the session if the password matches.
        //you might want to add something that handles if the password is invalid, you could add a page template and direct to that
        //after you login you can use the header function to forward the user to a page that displays their tasks.
        //        $record = accounts::findUser($_POST['email']);

        $user = accounts::findUserbyEmail($_REQUEST['email']);


        if ($user == FALSE) {
            echo 'user not found';
        } else {

            if($user->checkPassword($_POST['password']) == TRUE) {

                echo 'login';

                session_start();
                $_SESSION["userID"] = $user->id;

                //forward the user to the show all todos page
                // print_r($_SESSION);


                // $data = '';
                // self::getTemplate('login_form', $data);

                header("Location: index.php?page=tasks&action=all");
            } else {
                echo 'password does not match';
            }

        }




    }

    public static function loginform()
    {
        $data = '';
        self::getTemplate('login_form', $data);
    }

}

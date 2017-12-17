<?php
/**
 * Created by PhpStorm.
 * User: kwilliams
 * Date: 11/27/17
 * Time: 5:32 PM
 */


//each page extends controller and the index.php?page=tasks causes the controller to be called
class tasksController extends http\controller
{
    //each method in the controller is named an action.
    //to call the show function the url is index.php?page=task&action=show
    public static function show()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('show_task', $record);
    }

    //to call the show function the url is index.php?page=task&action=list_task

    public static function all()
    {
        // $records = todos::findAll();
        session_start();
        if(key_exists('userID',$_SESSION)) {
            $userID = $_SESSION['userID'];
            $userID = $_SESSION['userID'];
            $userData = accounts::findOne($userID);
            $records = todos::findTasksbyID($userID);
            if (is_array($records)) {
                foreach ($records as $eachTask) {
                    if ($eachTask->isdone =='1') {
                        $eachTask->isdone = 'Yes';
                    }elseif ($eachTask->isdone=='0') {
                        $eachTask->isdone = 'No';
                    }

                }
            }
            self::getTemplate('all_tasks', $records);
        } else {

            echo 'you must be logged in to view tasks';
        }

    }
    //to call the show function the url is called with a post to: index.php?page=task&action=create
    //this is a function to create new tasks

    //you should check the notes on the project posted in moodle for how to use active record here
//
    public static function create()
    {

        session_start();
        if(key_exists('userID',$_SESSION)) {
            $userID = $_SESSION['userID'];
            $record = accounts::findOne($userID);
            self::getTemplate('new_task', $record);
        } else {
            echo 'you must be logged in to create tasks';
        }
    }

    //this is the function to view edit record form
    public static function edit()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('edit_task', $record);

    }

    //this would be for the post for sending the task edit form
    public static function store()
    {
        session_start();
        $userID = $_SESSION['userID'];
        $userRecord = accounts::findOne($userID);

        $task = new todo();

        $task->message = $_POST['message'];
        $task->ownerid = $userRecord->id;
        $task->owneremail = $userRecord->email;
        $task->createddate = date("Y-m-d");
        $task->isdone = intval($_POST['isdone']);
        $task->duedate =  $_POST['duedate'];
        $task->save();
        // print_r($_POST);
        header("Location: index.php?page=tasks&action=all");

    }

    public static function save() {
        $task = todos::findOne($_REQUEST['id']);
// print_r($_POST);
        $task->message = $_POST['message'];
        $task->isdone = intval($_POST['isdone']);
        $task->duedate =  $_POST['duedate'];
        $task->save();
        header("Location: index.php?page=tasks&action=show&id=".$_REQUEST['id']);

    }

    //this is the delete function.  You actually return the edit form and then there should be 2 forms on that.
    //One form is the todo and the other is just for the delete button
    public static function delete()
    {
        $record = todos::findOne($_REQUEST['id']);
        $record->delete();
        print_r($_POST);
        header("Location: index.php?page=tasks&action=all");

    }

}
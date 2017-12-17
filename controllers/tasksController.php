<?php



class tasksController extends http\controller
{

    public static function show()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('show_task', $record);
    }


    public static function all()
    {

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


    public static function edit()
    {
        $record = todos::findOne($_REQUEST['id']);
        self::getTemplate('edit_task', $record);

    }


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
        $task->updateddate = ' ';
        $task->isdone = intval($_POST['isdone']);
        $task->duedate =  $_POST['duedate'];


        $validationError = $task->validate();
        if (!$validationError) {
            $task->save();
            header("Location: index.php?page=tasks&action=all");
        }else{
            self::getTemplate('new_task', $validationError);
        }

    }

    public static function save() {
        $task = todos::findOne($_REQUEST['id']);
        $task->message = $_POST['message'];
        $task->isdone = intval($_POST['isdone']);
        $task->duedate =  $_POST['duedate'];
        $task->updateddate =  date("Y-m-d");
        $task->save();
        header("Location: index.php?page=tasks&action=all");

    }


    public static function delete()
    {
        $record = todos::findOne($_REQUEST['id']);
        $record->delete();
        print_r($_POST);
        header("Location: index.php?page=tasks&action=all");

    }

}
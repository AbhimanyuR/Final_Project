<?php

final class todo extends database\model
{
    public $id;
    public $ownerid;
    public $owneremail;
    public $createddate;
    public $updateddate;
    public $duedate;
    public $message;
    public $isdone;
    protected static $modelName = 'todo';

    public static function getTablename()
    {

        $tableName = 'todos';
        return $tableName;
    }



    public function validate()
    {

        $valid = TRUE;
        $validationErrors = array();

        if (isset($this->message) && $this->message == '' ) {
            $valid = FALSE;
            $validationErrors[] = 'Please enter task message';
        }



        if($valid) {
            return FALSE;
        }else{
            return $validationErrors;
        }

    }
}

?>

<?php

final class todo extends database\model
{
    public $id;
    public $ownerid;
    public $owneremail;
    public $createddate;
    public $duedate;
    public $message;
    public $isdone;
    protected static $modelName = 'todo';

    public static function getTablename()
    {

        $tableName = 'todos';
        return $tableName;
    }
}

?>


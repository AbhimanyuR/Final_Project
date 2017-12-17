<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

date_default_timezone_set('US/Eastern');

$salt = '$2a$07$R.gJb2U2N.FmZ4hPp1y2CN$';

include_once "autoload.php";

include_once "database.php";

$response = http\processRequest::createResponse();


?>

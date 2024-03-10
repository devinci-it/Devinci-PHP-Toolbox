<?php

// Include the Composer autoload file
require_once "../../vendor/autoload.php";

// Import the necessary class
use Devinci\DatabaseCore\Database\Database;
use Devinci\Utilities\Logger\Logger;
$logger=new Logger("test.log");
$mydb=new Database(logger:$logger);

$mydb->connect();
//print_r($mydb);

echo "<pre>";
echo USERNAME."\n";
echo PASSWORD."\n";
echo ROOTPASSWORD."\n";
echo DATABASE."\n";
echo HOST."\n";
echo "</pre>";

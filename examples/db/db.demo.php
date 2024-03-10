<?php

// Include the Composer autoload file
require_once "../../vendor/autoload.php";

// Import the necessary class
use Devinci\DatabaseCore\Database\Database;
use Devinci\Utilities\Logger\Logger;
use Devinci\DevCore\EloquentUtils\EloquentUtils;

use Devinci\DatabaseCore\DatabaseUtility\DatabaseConnectionManager\DatabaseConnectionManager;
use Devinci\DatabaseCore\DatabaseUtility\DatabaseQueryExecutor\DatabaseQueryExecutor;
$logger=new Logger("test.log");
$mydb= new DatabaseConnectionManager();
$mydb::getConnection(logger:$logger);
$mydb::getConnection(logger:$logger);

var_dump( DatabaseConnectionManager::getActiveConnections());
$mydb::disconnectAll();
$mydb::getConnection(logger:$logger);

var_dump( DatabaseConnectionManager::getActiveConnections());


//$mydb->connect();
print_r($mydb);
$connectionManager = new DatabaseConnectionManager();

// Create a DatabaseQueryExecutor instance
$queryExecutor = new DatabaseQueryExecutor($connectionManager);

// Example 1: Execute a simple query
$query1 = "CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, name VARCHAR(255))";
$result1 = $queryExecutor->executeQuery($query1);

if ($result1) {
    $logger->log('Table "users" created successfully.', Logger::LOG_LEVEL_INFO);
} else {
    $logger->log('Error creating table "users".', Logger::LOG_LEVEL_ERROR);
}

// Example 2: Fetch all rows from a SELECT query
$query2 = "SELECT * FROM users";
$rows = $queryExecutor->fetchAll($query2);

if ($rows !== false) {
    foreach ($rows as $row) {
        $logger->log('User ID: ' . $row['id'] . ', Name: ' . $row['name'], Logger::LOG_LEVEL_INFO);
    }
} else {
    $logger->log('Error fetching users.', Logger::LOG_LEVEL_ERROR);
}
echo "<pre>";
echo USERNAME."\n";
echo PASSWORD."\n";
echo ROOTPASSWORD."\n";
echo DATABASE."\n";
echo HOST."\n";
echo "</pre>";

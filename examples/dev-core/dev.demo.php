<?php
include_once "../../vendor/autoload.php";

use Devinci\DatabaseCore\Database\Database;
use Devinci\Utilities\Logger\Logger;
use Illuminate\Contracts\Filesystem;
use Illuminate\Events\Dispatcher;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Schema\MySqlBuilder;

// Create a logger instance (replace with your actual logger implementation)
$logger = new Logger("eloquent.log");

// Create an instance of the Database class
$database = new Database($logger);

// Connect to the database
$database->connect();

// Run database migrations
$database->migrate();
// Disconnect (optional)
$database->disconnect();

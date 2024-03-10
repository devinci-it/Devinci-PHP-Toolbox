<?php

namespace Devinci\DatabaseCore\Database;

use Devinci\Utilities\Logger\Logger;

class Database
{
    private $connection;
    private $logger;
    private $config;

    public function __construct(array $config = [], Logger $logger = null)
    {
        // If constants are defined, use them as default values
        $config += [
            'host' => defined('HOST') ? HOST : '',
            'username' => defined('USERNAME') ? USERNAME : '',
            'password' => defined('PASSWORD') ? PASSWORD : 'P@',
            'database' => defined('DATABASE') ? DATABASE : '',
            'rootPassword' => defined('ROOTPASSWORD') ? ROOTPASSWORD : '',
        ];

        $this->config = $config;
        $this->logger = $logger;
    }

    /**
     * Establishes a database connection.
     *
     * @return bool True if the connection is successful, false otherwise.
     */
    public function connect()
    {
        $host = $this->config['host'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        $databaseName = $this->config['database'];

        // Implement your database connection logic here
        // Example using mysqli extension:
        $this->connection = new \mysqli($host, $username, $password, $databaseName);

        // Check the connection
        if ($this->connection->connect_error) {
            $this->logger->log('Failed to connect to the database: ' . $this->connection->connect_error, Logger::LOG_LEVEL_ERROR);
            return false;
        }

        $this->logger->log('Successfully connected to the database.', Logger::LOG_LEVEL_INFO);
        return true;
    }

    /**
     * Closes the database connection.
     */
    public function disconnect()
    {
        if ($this->connection) {
            $this->connection->close();
            $this->logger->log('Database connection closed.', Logger::LOG_LEVEL_INFO);
        }
    }
}

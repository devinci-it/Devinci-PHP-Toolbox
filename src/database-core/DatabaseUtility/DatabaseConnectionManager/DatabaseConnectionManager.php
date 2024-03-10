<?php

namespace Devinci\DatabaseCore\DatabaseUtility\DatabaseConnectionManager;

use Devinci\DatabaseCore\Database\Database;
use Devinci\Utilities\Logger\Logger;

class DatabaseConnectionManager
{
    private static $connections = [];

    /**
     * Get a database connection based on the configuration.
     *
     * @param array $config
     * @param Logger|null $logger
     * @return Database
     */
    public static function getConnection(array $config = [], Logger $logger = null): Database
    {
        $configHash = md5(serialize($config));

        if (!isset(self::$connections[$configHash])) {
            // Create a configuration array for the Database class
            $databaseConfig = self::createConfig($config);

            // Instantiate a new Database object
            self::$connections[$configHash] = new Database($logger);
            self::$connections[$configHash]->connect();
        }

        return self::$connections[$configHash];
    }

    /**
     * Disconnect all active database connections.
     */
    public static function disconnectAll()
    {
        foreach (self::$connections as $connection) {
            $connection->disconnect();
        }

        self::$connections = [];
    }

    public static function getActiveConnections()
    {
        return self::$connections;

    }

    /**
     * Create a configuration array for Database class.
     *
     * @param array $config
     * @return array
     */
    private static function createConfig(array $config): array
    {
        // Add additional logic here if needed
        return $config;
    }
}

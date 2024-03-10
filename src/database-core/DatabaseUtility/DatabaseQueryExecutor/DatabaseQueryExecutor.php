<?php

namespace Devinci\DatabaseCore\DatabaseUtility\DatabaseQueryExecutor;

use Devinci\DatabaseCore\DatabaseUtility\DatabaseConnectionManager\DatabaseConnectionManager;
use Devinci\DatabaseCore\Database\Database;
use Devinci\Utilities\Logger\Logger;

class DatabaseQueryExecutor
{
    private $connectionManager;

    public function __construct(DatabaseConnectionManager $connectionManager)
    {
        $this->connectionManager = $connectionManager;
    }

    /**
     * Execute an SQL query.
     *
     * @param string $query
     * @param array $params
     * @return bool
     */
    public function executeQuery(string $query, array $params = []): bool
    {
        $connection = $this->connectionManager->getConnection();
        $statement = $connection->prepare($query);

        if (!$statement) {
            // Log an error if the query preparation fails
            Logger::log('Error preparing query: ' . $connection->error, Logger::LOG_LEVEL_ERROR);
            return false;
        }

        // Bind parameters if provided
        if (!empty($params)) {
            $this->bindParams($statement, $params);
        }

        // Execute the query
        $result = $statement->execute();

        // Log an error if the query execution fails
        if (!$result) {
            Logger::log('Error executing query: ' . $statement->error, Logger::LOG_LEVEL_ERROR);
        }

        // Close the statement
        $statement->close();

        return $result;
    }

    /**
     * Fetch all rows from a SELECT query.
     *
     * @param string $query
     * @param array $params
     * @return array|bool
     */
    public function fetchAll(string $query, array $params = [])
    {
        $connection = $this->connectionManager->getConnection();
        $statement = $connection->prepare($query);

        if (!$statement) {
            // Log an error if the query preparation fails
            Logger::log('Error preparing query: ' . $connection->error, Logger::LOG_LEVEL_ERROR);
            return false;
        }

        // Bind parameters if provided
        if (!empty($params)) {
            $this->bindParams($statement, $params);
        }

        // Execute the query
        $result = $statement->execute();

        // Log an error if the query execution fails
        if (!$result) {
            Logger::log('Error executing query: ' . $statement->error, Logger::LOG_LEVEL_ERROR);
            return false;
        }

        // Fetch all rows
        $rows = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        // Close the statement
        $statement->close();

        return $rows;
    }

    /**
     * Bind parameters to a prepared statement.
     *
     * @param \mysqli_stmt $statement
     * @param array $params
     */
    private function bindParams(\mysqli_stmt $statement, array $params)
    {
        $types = str_repeat('s', count($params));
        $statement->bind_param($types, ...$params);
    }
}

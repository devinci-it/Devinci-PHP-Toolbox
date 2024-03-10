<?php

namespace Devinci\Utilities;

use Devinci\Utilities\Logger\Logger;

class ScriptHandler
{
    /**
     * Executes custom setup tasks during Composer events.
     *
     * @return void
     */
    public static function setup()
    {
        // Set up the log directory
        $logDirectory = __DIR__ . '/../../logs';
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0755, true);
        }

        // Create a Logger instance with a log file in the logs directory
        $logFilePath = $logDirectory . '/setup.log';
        $logger = new Logger($logFilePath);

        // Log information about how to use the Logger after initialization
        $logger->log('Welcome to the Devinci Utilities Logger!');
        $logger->log('You can use the Logger by creating an instance and calling the log method.');
        $logger->log('Example:');
        $logger->log('$logger = new \Devinci\Utilities\Logger(\'/path/to/log/file.log\');');
        $logger->log('$logger->log(\'Log message\');');
}

}
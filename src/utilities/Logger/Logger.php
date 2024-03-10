<?php

namespace Devinci\Utilities\Logger;

class Logger
{
    private $logFilePath;
    private $logLevel;

    const LOG_LEVEL_INFO = 'info';
    const LOG_LEVEL_WARNING = 'warning';
    const LOG_LEVEL_ERROR = 'error';

    public function __construct($logFilePath, $logLevel = self::LOG_LEVEL_INFO)
    {
        $this->logFilePath = $logFilePath;
        $this->logLevel = $logLevel;

        // Create the log directory if it doesn't exist
        $logDirectory = dirname($logFilePath);
        if (!is_dir($logDirectory)) {
            mkdir($logDirectory, 0755, true);
        }

        // Log information about the Logger object
        $this->log('Logger initialized. Log file: ' . $logFilePath);
    }

    public function log($message, $logLevel = null)
    {
        $logLevel = $logLevel ?: $this->logLevel;

        $logMessage = "[" . date("Y-m-d H:i:s") . "] [$logLevel] " . $message . PHP_EOL;
        file_put_contents($this->logFilePath, $logMessage, FILE_APPEND);
    }
}

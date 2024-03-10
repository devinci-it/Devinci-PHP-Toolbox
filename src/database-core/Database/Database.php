<?php

namespace Devinci\DatabaseCore\Database;

use Devinci\Utilities\Logger\Logger;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;
use Illuminate\Database\Schema\MySqlBuilder;

class Database
{
    private $logger;
    private $capsule;

    public function __construct(Logger $logger = null)
    {
        $this->logger = $logger??new Logger('db.log');

        // Initialize Eloquent ORM
        $capsule = new Capsule;
        $capsule->addConnection([
            'driver' => 'mysql',
            'host' => defined('HOST') ? HOST : '',
            'database' => defined('DATABASE') ? DATABASE : '',
            'username' => defined('USERNAME') ? USERNAME : '',
            'password' => defined('PASSWORD') ? PASSWORD : '',
            'charset' => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();


        $this->capsule = $capsule;
    }

    /**
     * Establishes a database connection.
     *
     * @return bool True if the connection is successful, false otherwise.
     */
    public function connect()
    {
        try {
            // Attempt to connect using Eloquent
            $this->capsule->connection()->getPdo();

            $this->logger->log('Successfully connected to the database using Eloquent.', Logger::LOG_LEVEL_INFO);
            return true;
        } catch (\Exception $e) {
            $this->logger->log('Failed to connect to the database using Eloquent: ' . $e->getMessage(), Logger::LOG_LEVEL_ERROR);
            return false;
        }
    }
    /**
     * Run database migrations.
     */
    public function migrate()
    {
        try {
            // Get the migrator instance
            $migrator = $this->getMigrator();

            // Run the migrations
            $migrator->run(__DIR__.'/../../../server/Migrations');

            $this->logger->log('Database migrations completed successfully.', Logger::LOG_LEVEL_INFO);
        } catch (\Exception $e) {
            $this->logger->log('An error occurred during database migrations: ' . $e->getMessage(), Logger::LOG_LEVEL_ERROR);
        }
    }

    /**
     * Get the migrator instance.
     *
     * @return Migrator
     */
    /**
     * Get the migrator instance.
     *
     * @return Migrator
     */
    /**
     * Get the migrator instance.
     *
     * @return Migrator
     */
    public function getMigrator(?Filesystem $filesystem = null, ?string $migrationPath = null)
    {
        $repository = new \Illuminate\Database\Migrations\DatabaseMigrationRepository(
            $this->capsule->getDatabaseManager(),
            'migrations'
        );

        if (!$filesystem) {
            $filesystem = new \Illuminate\Filesystem\Filesystem();
        }

        $migrationPath = $migrationPath ?: (__DIR__.'/../../../server/Migrations');

        return new Migrator(
            $repository,
            $this->capsule->getDatabaseManager(),
            $filesystem,
            new \Illuminate\Events\Dispatcher(),
            new \Illuminate\Database\Schema\MySqlBuilder($this->capsule->connection())
        );
    }


    /**
     * Closes the database connection.
     */
    public function disconnect()
    {
        // Eloquent doesn't require explicit disconnect
    }
}

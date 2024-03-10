<?php

namespace Devinci\DevCore;

use Devinci\DevCore\ComposerUtils\ComposerUtils;

class DevCore
{
    private static $config;

    private static $vendorName;
    private static $baseLibraryPath;
    private static $libraryName;
    private static $libraryLocation;
    private static $composerJsonPath;
    private static $generatedModelsDirectory;
    private static $generatedMigrationsDirectory;

    public function __construct()
    {
        $this->loadConfig();
        $this->defineConstants();
        $this->setAttributes();
    }

    public static function loadConfig()
    {
        // Read the config.ini file
        self::$config = parse_ini_file(__DIR__ . '/config.ini', true);

        // Check if the config is loaded successfully
        if (!self::$config) {
            throw new \Exception("Failed to load config.ini file.");
        }
    }

    private function setAttributes()
    {
        // Set attributes based on config values or use default values
        self::$vendorName = self::$config['vendor_name'] ?? null;
        self::$baseLibraryPath = self::$config['base_library_path'] ?? null;
        self::$libraryName = self::$config['library_name'] ?? null;
        self::$libraryLocation = self::$config['library_location'] ?? null;
        self::$composerJsonPath = $this->getFullPath(self::$config['composer_json_path']) ?? null;
        self::$generatedModelsDirectory = $this->getFullPath(self::$config['generated_models_directory']) ?? null;
        self::$generatedMigrationsDirectory = $this->getFullPath(self::$config['generated_migrations_directory']) ?? null;
    }

    private function defineConstants()
    {
        // Define constants based on config values or use default values
        define('GENERATED_MODELS_DIRECTORY', self::$config['generated_models_directory'] ?? __DIR__ . '/../../generated/models');
        define('GENERATED_MIGRATIONS_DIRECTORY', self::$config['generated_migrations_directory'] ?? __DIR__ . '/../../generated/migrations');
    }

    public static function getVendorName()
    {
        return self::$vendorName;
    }

    public static function getBaseLibraryPath()
    {
        return self::$baseLibraryPath;
    }

    public static function getLibraryName()
    {
        return self::$libraryName;
    }

    public static function getLibraryLocation()
    {
        return self::$libraryLocation;
    }

    public static function getComposerJsonPath()
    {
        return self::$composerJsonPath;
    }

    public static function getGeneratedModelsDirectory()
    {
        return self::$generatedModelsDirectory ?? __DIR__ . '/../../server/Models';
    }


    public static function getGeneratedMigrationsDirectory()
    {
        return self::$generatedMigrationsDirectory ?? __DIR__ . '/../../server/Migrations';
    }

    private function getFullPath($path)
    {
        // Replace %DIR% with the actual __DIR__ value
        return $path ? str_replace('%DIR%', __DIR__, $path) : null;
    }

    public static function getComposerJsonContent()
    {
        $composerJsonPath = self::getComposerJsonPath();

        if ($composerJsonPath && file_exists($composerJsonPath)) {
            $composerJsonContent = json_decode(file_get_contents($composerJsonPath), true);
            return $composerJsonContent;
        } else {
            echo "Composer.json does not exist at '$composerJsonPath'\n";
            return null;
        }
    }

    public static function setupLibrary($libraryName, $classes, $isNewProject = true)
    {
        ComposerUtils::setLibraryName($libraryName);

        foreach ($classes as $class) {
            ComposerUtils::addClassDirectory($class);
        }

        ComposerUtils::initializeLibrary();
    }
}



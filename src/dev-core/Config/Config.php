<?php

namespace Devinci\DevCore\Config;

use Devinci\DevCore\DevCore;

class Config
{
    public static $vendorName;
    public static $baseLibraryPath;
    public static $composerJsonPath;
    public static $generatedModelsDirectory;
    public static $generatedMigrationsDirectory;

    public static function load()
    {
        // Load configuration from DevCore
        DevCore::loadConfig();

        // Set global variables
        self::$vendorName = DevCore::getVendorName();
        self::$baseLibraryPath = DevCore::getBaseLibraryPath();
        self::$composerJsonPath = DevCore::getComposerJsonPath();
        self::$generatedModelsDirectory = DevCore::getGeneratedModelsDirectory();
        self::$generatedMigrationsDirectory = DevCore::getGeneratedMigrationsDirectory()
        ;
    }
}

// Load configuration when including this file
Config::load();

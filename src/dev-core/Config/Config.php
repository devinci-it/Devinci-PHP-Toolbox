<?php

namespace Devinci\DevCore\Config;

use Devinci\DevCore\DevCore;

class Config
{
    public static $vendorName;
    public static $baseLibraryPath;
    public static $composerJsonPath;

    public static function load()
    {
        // Load configuration from DevCore
        DevCore::loadConfig();

        // Set global variables
        self::$vendorName = DevCore::getVendorName();
        self::$baseLibraryPath = DevCore::getBaseLibraryPath();
        self::$composerJsonPath = DevCore::getComposerJsonPath();
    }
}

// Load configuration when including this file
Config::load();
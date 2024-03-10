<?php

namespace Devinci\DevCore;

use Devinci\DevCore\ComposerUtils\ComposerUtils;

class DevCore
{
    private static $config;

    public static function loadConfig()
    {
        // Read the config.ini file
        self::$config = parse_ini_file(__DIR__ . '/config.ini', true);

        // Check if the config is loaded successfully
        if (!self::$config) {
            throw new \Exception("Failed to load config.ini file.");
        }
    }

    public static function getVendorName()
    {
        return self::$config['vendor_name'];
    }

    public static function getBaseLibraryPath()
    {
        return self::$config['base_library_path'];
    }

    public static function getLibraryName()
    {
        return self::$config['library_name'];
    }

    public static function getLibraryLocation()
    {
        return self::$config['library_location'];
    }

    public static function getComposerJsonPath()
    {
        $composerJsonPath = self::$config['composer_json_path'];

        // Replace %DIR% with the actual __DIR__ value
        $composerJsonPath = str_replace('%DIR%', __DIR__, $composerJsonPath);

        return $composerJsonPath;
    }

    public static function getComposerJsonContent()
    {
        $composerJsonPath = self::getComposerJsonPath();

        if (file_exists($composerJsonPath)) {
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

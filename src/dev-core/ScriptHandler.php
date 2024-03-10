<?php

// ScriptHandler.php

namespace Devinci\DevCore;

use Composer\Script\Event as ScriptEvent;

class ScriptHandler
{
    const INI_FILE = __DIR__ . '/config.ini';

    public static function postAutoloadDump(ScriptEvent $event)
    {
        // Get the parameters from the argv property
        $args = $event->getArguments();

        // Set default values or use provided values
        $vendorName = $args[0] ?? 'devinci';
        $baseLibraryPath = $args[1] ?? __DIR__ . '/../../src';
        $composerJsonPath = $args[2] ?? __DIR__ . '/../../composer.json';

        // Generate config.ini content
        $configIniContent = <<<INI
; Configuration file for Devinci Library Setup

; Vendor name for the new library
vendor_name = "$vendorName"

; Base path for the new library
base_library_path = "$baseLibraryPath"

; Path to the main composer.json file
composer_json_path = "$composerJsonPath"

INI;

        // Write config.ini content
        file_put_contents(self::INI_FILE, $configIniContent);

        // Read from config.ini
        $config = parse_ini_file(self::INI_FILE, true);

        // Use the config values
        echo "Vendor Name: " . $config['vendor_name'] . "\n";
        echo "Base Library Path: " . $config['base_library_path'] . "\n";
        echo "Composer JSON Path: " . $config['composer_json_path'] . "\n";
    }
}

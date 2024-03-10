<?php

namespace Devinci\UICore;

class ScriptHandler
{
    const CSS_SOURCE_PATH = __DIR__ . '/static/css/';
    const ICON_SOURCE_PATH = __DIR__ . '/static/assets/icons/';
    const PUBLIC_PATH = __DIR__ . '/../../public/';

    public static function copyCssFiles()
    {
        self::createPublicDirectories();

        $destinationPath = self::PUBLIC_PATH . 'css/';

        // Copy all CSS files from source to destination
        $files = glob(self::CSS_SOURCE_PATH . '*.css');
        foreach ($files as $file) {
            $filename = basename($file);
            copy($file, $destinationPath . $filename);
        }
    }

    public static function copyIconFiles()
    {
        self::createPublicDirectories();

        $destinationPath = self::PUBLIC_PATH . 'icons/';

        // Copy all icon files from source to destination
        $files = glob(self::ICON_SOURCE_PATH . '*.svg');
        foreach ($files as $file) {
            $filename = basename($file);
            copy($file, $destinationPath . $filename);
        }
    }

    private static function createPublicDirectories()
    {
        // Create the public directory if it doesn't exist
        if (!is_dir(self::PUBLIC_PATH)) {
            mkdir(self::PUBLIC_PATH, 0777, true);
        }

        // Create the 'css' directory within the public directory if it doesn't exist
        $cssPath = self::PUBLIC_PATH . 'css/';
        if (!is_dir($cssPath)) {
            mkdir($cssPath, 0777, true);
        }

        // Create the 'icons' directory within the public directory if it doesn't exist
        $iconsPath = self::PUBLIC_PATH . 'icons/';
        if (!is_dir($iconsPath)) {
            mkdir($iconsPath, 0777, true);
        }
    }
}

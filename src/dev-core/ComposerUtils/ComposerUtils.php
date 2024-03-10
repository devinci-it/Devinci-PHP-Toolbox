<?php

namespace Devinci\DevCore\ComposerUtils;

use Devinci\DevCore\DevCore;

class ComposerUtils
{
    private static $libraryName;
    private static $classDirectories = [];


    public static function setLibraryName($libraryName)
    {
        self::$libraryName = $libraryName;
        return new self();
    }


    public static function addClassDirectory($classDirectory)
    {
        self::$classDirectories[] = ucfirst($classDirectory); // Use PascalCase
        return new self();
    }


    public static function updateMainComposerJson($content, $libraryName)
    {
        $composerJsonPath = DevCore::getComposerJsonPath();
        $vendorName = DevCore::getVendorName();
        if (file_exists($composerJsonPath)) {
            $composerJsonContent = json_decode(file_get_contents($composerJsonPath), true);

            $composerJsonContent['scripts'] = $composerJsonContent['scripts'] ?? [];

// Define your custom script name
            $customScriptName = strtolower($vendorName)."-setup-{$libraryName}";

// Check if the custom script already exists
            if (!isset($composerJsonContent['scripts'][$customScriptName])) {
                // If not, append it to the existing post-autoload-dump scripts
                $namespace = ucfirst(DevCore::getVendorName()) . '\\' . self::convertToPascalCase(self::$libraryName);
                $setupScript = "$namespace\\ScriptHandler::setup";

                // Ensure the post-autoload-dump key exists before appending to it
                $composerJsonContent['scripts']['post-autoload-dump'] = $composerJsonContent['scripts']['post-autoload-dump'] ?? [];

                // Append the custom script to the existing post-autoload-dump scripts
                $composerJsonContent['scripts']['post-autoload-dump'][] = $setupScript;
            } else {
                // If it exists, handle it accordingly (you might want to log a warning or take other actions)
                echo "Custom script '$customScriptName' already exists. Skipping...\n";
            }

            // Add or update require in the main composer.json
            $composerJsonContent['require'] = array_merge($composerJsonContent['require'] ?? [], $content['require'] ?? []);

            // Add or update repositories in the main composer.json
            $repositories = $content['repositories'] ?? [];
            $existingRepositories = $composerJsonContent['repositories'] ?? [];

            // Filter out existing repositories by type and url
            $filteredRepositories = array_filter($existingRepositories, function ($repo) use ($repositories) {
                return !in_array($repo, $repositories);
            });

            // Merge the filtered and new repositories
            $composerJsonContent['repositories'] = array_merge($filteredRepositories, $repositories);

            // Add new library to require and repositories
            $libraryNamespace = strtolower(DevCore::getVendorName()) . '/' . self::$libraryName;
            $composerJsonContent['require'][$libraryNamespace] = 'dev-main';
            $composerJsonContent['repositories'][] = [
                "type" => "path",
                "url" => "./src/{$libraryName}"
            ];

            file_put_contents($composerJsonPath, json_encode($composerJsonContent, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            echo "Composer.json updated successfully at '$composerJsonPath'\n";
        } else {
            echo "Composer.json does not exist at '$composerJsonPath'\n";
        }
    }
    public static function createScriptHandler($libraryPath)
    {
        $scriptHandlerPath = $libraryPath . '/ScriptHandler.php';
        $namespace = ucfirst(DevCore::getVendorName()) . '\\' . self::convertToPascalCase(self::$libraryName);

        if (!file_exists($scriptHandlerPath)) {
            // Create a PHP file for the ScriptHandler class with the correct namespace
            $scriptHandlerContent = "<?php\n\nnamespace $namespace;\n\nclass ScriptHandler\n{\n    /**
     * Executes custom setup tasks during Composer events.
     *
     * @return void
     */
    public static function setup()
    {
        // Add your custom setup tasks here
    }
}";

            file_put_contents($scriptHandlerPath, $scriptHandlerContent);
            echo "ScriptHandler class created successfully at '$scriptHandlerPath'\n";
        } else {
            echo "ScriptHandler class already exists at '$scriptHandlerPath'\n";
        }
    }
    private static function createDirectories()
    {
        $pascalCaseLibraryName = self::convertToPascalCase(self::$libraryName);
        $baseLibraryPath = DevCore::getBaseLibraryPath();
        $libraryPath = $baseLibraryPath . '/' . self::$libraryName;

        // Create the library directory
        if (!file_exists($libraryPath)) {
            mkdir($libraryPath, 0777, true);
            echo "Library directory '$pascalCaseLibraryName' created successfully at '$libraryPath'\n";
        } else {
            echo "Library directory '$pascalCaseLibraryName' already exists at '$libraryPath'\n";
        }

        // Create class directories
        foreach (self::$classDirectories as $classDirectory) {
            $pascalCaseClassDirectory = self::convertToPascalCase($classDirectory);
            $fullPath = $libraryPath . '/' . $pascalCaseClassDirectory;

            if (!file_exists($fullPath)) {
                mkdir($fullPath, 0777, true);
                echo "Class directory '$pascalCaseClassDirectory' created successfully at '$fullPath'\n";

                // Create a PHP file for each class with the correct namespace
                $classFilePath = $fullPath . '/' . $pascalCaseClassDirectory . '.php';
                $namespace = ucfirst(DevCore::getVendorName()) . '\\' . $pascalCaseLibraryName . '\\' . $pascalCaseClassDirectory;
                $classContent = "<?php\n\nnamespace $namespace;\n\nclass $pascalCaseClassDirectory\n{\n\n}";

                file_put_contents($classFilePath, $classContent);
                echo "Class file '$pascalCaseClassDirectory.php' created successfully at '$classFilePath'\n";
            } else {
                echo "Class directory '$pascalCaseClassDirectory' already exists at '$fullPath'\n";
            }
        }

        return $libraryPath;
    }

    private static function includeClassFiles($libraryPath)
    {
        $namespace = ucfirst(DevCore::getVendorName()) . '\\' . self::convertToPascalCase(self::$libraryName);

        // Include class files
        foreach (self::$classDirectories as $classDirectory) {
            $pascalCaseClassDirectory = self::convertToPascalCase($classDirectory);
            $directoryPath = $libraryPath . '/' . $pascalCaseClassDirectory;

            if (file_exists($directoryPath) && is_dir($directoryPath)) {
                foreach (scandir($directoryPath) as $file) {
                    if (is_file($directoryPath . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                        $className = pathinfo($file, PATHINFO_FILENAME);
                        require_once $directoryPath . '/' . $file;
                        echo "Class '$namespace\\$pascalCaseClassDirectory\\$className' included\n";
                    }
                }
            } else {
                echo "Class directory '$pascalCaseClassDirectory' does not exist at '$directoryPath'\n";
            }
        }
    }

    private static function updateComposerJson($namespace, $libraryPath)
    {
        $composerJsonPath = $libraryPath . '/composer.json';
        $namespace = ucfirst($namespace);

        if (!file_exists($composerJsonPath)) {
            // Create an entry for the library namespace
            $autoload = [
                "psr-4" => [
                    "$namespace\\" => '',
                ],
            ];

            // Create entries for each class namespace
            foreach (self::$classDirectories as $classDirectory) {
                $pascalCaseClassDirectory = self::convertToPascalCase($classDirectory);
                $autoload["psr-4"]["$namespace\\$pascalCaseClassDirectory\\"] = $pascalCaseClassDirectory;
            }

            $composerJsonContent = json_encode([
                "name" => strtolower(DevCore::getVendorName() . '/' . self::$libraryName),
                "description" => ucfirst(self::$libraryName) . " Library",
                "require" => [],
                "autoload" => $autoload,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

            file_put_contents($composerJsonPath, $composerJsonContent);
            echo "Composer.json created successfully at '$composerJsonPath'\n";
        } else {
            echo "Composer.json already exists at '$composerJsonPath'\n";
        }
    }

    private static function convertToPascalCase($string)
    {
        $string = str_replace('-', ' ', $string);
        $string = ucwords($string);
        $string = str_replace(' ', '', $string);

        return $string;
    }

    public static function initializeLibrary()
    {
        $libraryPath = self::createDirectories();
        self::includeClassFiles($libraryPath);
        self::updateComposerJson(DevCore::getVendorName() . '\\' . self::convertToPascalCase(self::$libraryName), $libraryPath);

        // Update main composer.json with the current content
        $composerJsonContent = DevCore::getComposerJsonContent();
        self::createScriptHandler($libraryPath);
        self::updateMainComposerJson($composerJsonContent,self::$libraryName);

        echo "Initialization for library '" . self::$libraryName . "' completed!\n";
        return new self();
    }
}
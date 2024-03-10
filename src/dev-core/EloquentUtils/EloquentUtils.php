<?php

namespace Devinci\DevCore\EloquentUtils;


use Devinci\DevCore\Config\Config;
use Devinci\DevCore\DevCore;


class EloquentUtils
{
    /**
     * Generate an Eloquent migration file.
     *
     * @param string $tableName
     * @param array $columns
     */
    public static function generateMigration($tableName, $columns)
    {
        $migrationContent = EloquentGenerator::generateMigration($tableName, $columns);
        $migrationFileName = self::getMigrationFileName($tableName);

        // Ensure the migrations directory exists
        self::ensureMigrationsDirectory();

        // Write the migration content to the file
        file_put_contents(DevCore::getGeneratedMigrationsDirectory() . '/' . $migrationFileName, $migrationContent);

        echo "Migration file generated: " . $migrationFileName . PHP_EOL;
    }
    /**
     * Generate Eloquent model file.
     *
     * @param string $modelName
     * @param string $tableName
     */
    public static function generateModel($modelName, $tableName)
    {
        $modelContent = EloquentGenerator::generateModel($modelName, $tableName);
        $modelFileName = $modelName . '.php';

        // Ensure the models directory exists
        self::ensureModelsDirectory();

        // Write the model content to the file
        file_put_contents(DevCore::getGeneratedModelsDirectory() . '/' . $modelFileName, $modelContent);

        echo "Model file generated: " . $modelFileName . PHP_EOL;
    }

    /**
     * Generate the content for an Eloquent migration file.
     *
     * @param string $tableName
     * @param array $columns
     * @return string
     */
    /**
     * Generate the content for an Eloquent model file.
     *
     * @param string $modelName
     * @param string $tableName
     * @param array $columns
     * @return string
     */
    private static function generateModelContent($modelName, $tableName, $columns)
    {
        $templatePath = __DIR__ . '/Templates/model_template.php.template';
        $templateContent = file_get_contents($templatePath);

        // Replace placeholders with actual values
        $modelContent = str_replace(['{{ modelName }}', '{{ tableName }}', '{{ columnDefinitions }}'], [$modelName, $tableName, self::generateColumnDefinitions($columns)], $templateContent);

        return $modelContent;
    }

    // Add a private method to generate column definitions
    private static function generateColumnDefinitions($columns)
    {
        $columnDefinitions = '';
        foreach ($columns as $column) {
            $columnDefinitions .= "    protected $" . $column . ";\n";
        }

        return $columnDefinitions;
    }

    private static function generateMigrationContent($tableName, $columns)
    {
        $templatePath = __DIR__ . '/Templates/migration_template.php.template';
        $templateContent = file_get_contents($templatePath);

        // Replace placeholders with actual values
        $migrationContent = str_replace('{{ tableName }}', $tableName, $templateContent);

        // Add column definitions
        $columnDefinitions = '';
        foreach ($columns as $column) {
            $columnDefinitions .= "            // Add your logic for column: {$column}\n";
        }

        $migrationContent = str_replace('{{ columnDefinitions }}', $columnDefinitions, $migrationContent);

        return $migrationContent;
    }
    /**
     * Ensure the migrations directory exists.
     */
    private static function ensureMigrationsDirectory()
    {
        $migrationsDirectory = DevCore::getGeneratedMigrationsDirectory();

        if (!is_dir($migrationsDirectory)) {
            mkdir($migrationsDirectory, 0755, true);
        }
    }

    /**
     * Ensure the models directory exists.
     */
    private static function ensureModelsDirectory()
    {
        $modelsDirectory = DevCore::getGeneratedModelsDirectory();

        if (!is_dir($modelsDirectory)) {
            mkdir($modelsDirectory, 0755, true);
        }
    }

    /**
     * Get the migration file name based on the table name.
     *
     * @param string $tableName
     * @return string
     */
    private static function getMigrationFileName($tableName)
    {
        $timestamp = date('Y_m_d_His');
        return $timestamp . '_create_' . $tableName . '_table.php';
    }

    public static function generateEloquentFiles($modelName, $tableName, $columns)
    {
        // Use EloquentGenerator directly
        $contents = EloquentGenerator::generate($modelName, $tableName, $columns);

        // Access the generated migration content
        $migrationContent = $contents['migration'];

        // Access the generated model content
        $modelContent = $contents['model'];

        // Ensure the migrations directory exists
        self::ensureMigrationsDirectory();

        // Ensure the models directory exists
        self::ensureModelsDirectory();

        // Write the migration content to the file
        file_put_contents(DevCore::getGeneratedMigrationsDirectory() . '/' . self::getMigrationFileName($tableName), $migrationContent);

        // Write the model content to the file
        file_put_contents(DevCore::getGeneratedModelsDirectory() . '/' . $modelName . '.php', $modelContent);

        echo "Migration and Model files generated." . PHP_EOL;
    }


}
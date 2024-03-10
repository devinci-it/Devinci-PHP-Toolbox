<?php

namespace Devinci\DevCore\EloquentUtils;

use Devinci\DatabaseCore\Column\Column;

class EloquentGenerator
{
    /**
     * Generate an Eloquent migration file.
     *
     * @param string $tableName
     * @param array $columns
     * @return string Generated migration content
     */
    public static function generateMigration($tableName, $columns)
    {
        $templatePath = __DIR__ . '/Templates/migration_template.php.template';
        $templateContent = file_get_contents($templatePath);

        // Replace placeholders with actual values
        $migrationContent = str_replace('{{ tableName }}', $tableName, $templateContent);

        // Add column definitions
        $columnDefinitions = '';
        foreach ($columns as $column) {
            $columnDefinitions .= self::generateMigrationColumnDefinition($column);
        }

        $migrationContent = str_replace('{{ columnDefinitions }}', $columnDefinitions, $migrationContent);

        return $migrationContent;
    }

    private static function generateMigrationColumnDefinition($column)
    {
        // Customize the column definition based on your needs
        $definition = "\$table->{$column->getType()}('{$column->getName()}')";

        // Add additional attributes (e.g., length, unsigned, foreign key, etc.)
        if ($column->hasAttributes()) {
            $definition .= $column->getAttributes();
        }

        $definition .= ";\n";

        return $definition;
    }
    /**
     * Generate Eloquent model file.
     *
     * @param string $modelName
     * @param string $tableName
     * @return string Generated model content
     */
    public static function generateModel($modelName, $tableName, $columns)
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
            $column= $column->getName();
            $columnDefinitions .= "    protected $" . $column . ";\n";
        }

        return $columnDefinitions;
    }
    /**
     * Generate both Eloquent migration and model files.
     *
     * @param string $modelName
     * @param string $tableName
     * @param array $columns
     * @return string ['migration' => $migrationContent, 'model' => $modelContent]
     */
    /**
     * Generate both Eloquent migration and model files.
     *
     * @param string $modelName
     * @param string $tableName
     * @param array $columns
     * @return string ['migration' => $migrationContent, 'model' => $modelContent]
     */
    public static function generate($modelName, $tableName, $columns)
    {
        $migrationContent = self::generateMigration($tableName, $columns);
        $modelContent = self::generateModel($modelName, $tableName,$columns);

        return ['migration' => $migrationContent, 'model' => $modelContent];
    }

}

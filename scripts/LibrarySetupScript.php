<?php

/**
 * Library Setup Script
 *
 * This script assists in the setup of a new library by automating tasks using the DevCore library.
 * It provides a convenient way to initialize and configure a new library, including directory creation,
 * updating composer.json, and generating configuration files.
 *
 * Usage:
 * 1. Include this script in your project, adjusting the path to the autoload.php file if necessary.
 * 2. Run the script to set up a new library based on the specified parameters.
 *
 * Note: Ensure that the DevCore library is properly installed and configured in your project.
 *
 * @file      LibrarySetupScript.php
 * @author    Your Name
 * @copyright Copyright (c) Your Company
 * @license   MIT License
 */

require_once "../vendor/autoload.php";

use Devinci\DevCore\DevCore;

/**
 * Setup a new library based on the provided parameters.
 *
 * @param array $libraryParams An associative array containing library setup parameters.
 *                             Keys: 'name' (library name), 'classes' (array of classes).
 */
function setupLibrary(array $libraryParams)
{
    // Load configuration
    DevCore::loadConfig();

    $libName = $libraryParams['name'];
    $classes = $libraryParams['classes'];

    // Call the setupLibrary method to perform library setup tasks
    DevCore::setupLibrary($libName, $classes);
}

// Example: Setup a library with custom parameters
/*

$customLibraryParams = [
    'name'    => 'custom-library',
    'classes' => ['CustomClass1', 'CustomClass2'],
];


 */


/* LIBRARY ARRAYS */
$librariesToSetup = [
//    [
//        'name' => 'utilities',
//        'classes' => ['Logger'],
//    ],
    [
        'name' => 'database-core',
        'classes' => ['Database'],
    ],
];


foreach ($librariesToSetup as $libraryParams) {
    setupLibrary($libraryParams);
}




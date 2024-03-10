<?php

/**
 * Example Script for Devinci Library Setup
 *
 * This script demonstrates how to use the DevCore library to set up a new library in your project.
 * It loads the configuration, specifies the library name and classes, and then calls the setupLibrary method
 * from DevCore to perform the necessary setup tasks such as creating directories, generating class files,
 * updating the composer.json file, and initializing the library.
 *
 * Usage:
 * 1. Include this script in your project, adjusting the path to the autoload.php file if necessary.
 * 2. Run the script to set up a new library based on the specified library name and classes.
 *
 * Note: Ensure that the DevCore library is properly installed and configured in your project.
 *
 * @file      ExampleSetupScript.php
 * @author    Your Name
 * @copyright Copyright (c) Your Company
 * @license   MIT License
 */

require_once "../../vendor/autoload.php";

use Devinci\DevCore\DevCore;

// Load configuration
DevCore::loadConfig();

// Specify the library name and classes
$libName = 'db-core';
$classes = ['Database', 'DatabaseConfig'];

// Call the setupLibrary method to perform library setup tasks
DevCore::setupLibrary($libName, $classes);

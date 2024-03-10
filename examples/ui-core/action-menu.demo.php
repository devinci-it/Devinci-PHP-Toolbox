<?php

require_once "../../vendor/autoload.php";

use Devinci\UICore\ActionMenu\ActionMenuBuilder;
use Devinci\UICore\UICore;

UICore::includeCssFiles("../../public/");

// Sample actions
$actions = [
    ['name' => 'Home', 'path' => '/home', 'icon' => 'browse.svg'],
    ['name' => 'Profile', 'path' => '/profile', 'icon' => 'browse.svg'],
    // Add more actions as needed
];

// Assuming $iconsPath is the path where icons are copied
$iconsPath = '../../public/icons/';

// Create an instance of ActionMenuBuilder
$actionMenuBuilder = new ActionMenuBuilder($actions);
$actionMenuBuilder->setIconPath($iconsPath);

// Build the ActionMenu
$actionMenu = $actionMenuBuilder->build();

// Render the ActionMenu
$actionMenu->render();

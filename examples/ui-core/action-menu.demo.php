<?php

require_once "../../vendor/autoload.php";

use Devinci\UICore\ActionMenu\ActionMenuBuilder;
use Devinci\UICore\UICore;

UICore::includeCssFiles("../../public/");

// Sample actions
$actions = [
    ['name' => 'Copy', 'path' => '/copy', 'icon' => 'create.svg'],
    ['name' => 'Move', 'path' => '/move', 'icon' => 'up.svg'],
    ['name' => 'Delete', 'path' => '/delete', 'icon' => 'del.svg'],
    ['name' => 'Files', 'path' => '/files', 'icon' => 'browse.svg'],
    ['name' => 'Settings', 'path' => '/settings', 'icon' => 'gear.svg'],
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

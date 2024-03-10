
# ActionMenu Class (UICore)

The `ActionMenu` class is a part of the UI Core Library within the Devinci PHP Toolbox. It facilitates the creation of interactive action menus with icons. This README provides guidance on utilizing the `ActionMenu` class effectively within the context of the Devinci PHP Toolbox.

## Getting Started

To use the `ActionMenu` class, follow these steps:

### Installation

Make sure you have the Devinci PHP Toolbox project cloned on your local machine. Navigate to the project directory and install dependencies using Composer:

```bash
git clone https://github.com/devinci-it/Devinci-PHP-Toolbox.git
cd Devinci-PHP-Toolbox
composer install
```

### Example Usage

```php
<?php

require_once "vendor/autoload.php";

use Devinci\UICore\ActionMenu\ActionMenuBuilder;
use Devinci\UICore\UICore;

UICore::includeCssFiles("public/");

// Sample actions
$actions = [
    ['name' => 'Home', 'path' => '/home', 'icon' => 'browse.svg'],
    ['name' => 'Profile', 'path' => '/profile', 'icon' => 'browse.svg'],
    // Add more actions as needed
];

// Assuming $iconsPath is the path where icons are copied
$iconsPath = 'public/icons/';

// Create an instance of ActionMenuBuilder
$actionMenuBuilder = new ActionMenuBuilder($actions);
$actionMenuBuilder->setIconPath($iconsPath);

// Build the ActionMenu
$actionMenu = $actionMenuBuilder->build();

// Render the ActionMenu
$actionMenu->render();
```

### ActionMenuBuilder

The `ActionMenuBuilder` class allows you to construct an `ActionMenu` instance with ease. It offers methods for setting individual properties, including name, path, and icon.

#### Example of Adding Actions

```php
<?php

use Devinci\UICore\ActionMenu\ActionMenuBuilder;

// Sample actions
$actions = [
    ['name' => 'Home', 'path' => '/home', 'icon' => 'browse.svg'],
    ['name' => 'Profile', 'path' => '/profile', 'icon' => 'browse.svg'],
    // Add more actions as needed
];

// Create an instance of ActionMenuBuilder
$actionMenuBuilder = new ActionMenuBuilder($actions);

// Additional actions can be added using the addAction method
$actionMenuBuilder->addAction('Settings', '/settings', 'settings.svg');

// Build the ActionMenu
$actionMenu = $actionMenuBuilder->build();

// Render the ActionMenu
$actionMenu->render();
```

### Customization

You can customize the appearance of the `ActionMenu` by setting the icon path using `setIconPath($path)`. This allows flexibility in handling the location of icon assets.

### Dev-Friendly Interface

The builder pattern ensures a developer-friendly interface for constructing the `ActionMenu`. It promotes clean, expressive, and readable code, making it easier to understand and maintain your UI components.

Feel free to explore other components and libraries within the Devinci PHP Toolbox for a comprehensive set of tools to enhance your PHP development experience.



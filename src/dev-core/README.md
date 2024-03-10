# Dev Core Library (dev-core)

The Dev Core Library is a versatile utility designed to streamline the setup and initialization of PHP libraries within your Devinci framework project. It provides essential functionality for creating directories, updating `composer.json`, and generating configuration files.

## Getting Started

To integrate the Dev Core Library into your project, follow these steps:

### 1. Installation

Clone the library from the [Devinci PHP Toolbox GitHub repository](https://github.com/devinci-it/Devinci-PHP-Toolbox):

```bash
git clone https://github.com/devinci-it/Devinci-PHP-Toolbox.git
```

### 2. Usage

Use the `DevCore` class to set up and configure your PHP libraries. Here's an example script:

```php
<?php

require_once "../vendor/autoload.php";

use Devinci\DevCore\DevCore;

// Load configuration
DevCore::loadConfig();

$libName = 'your-library-name';
$classes = ['YourClass1', 'YourClass2'];
DevCore::setupLibrary($libName, $classes);
```

### 3. Configuration

Adjust library configuration by modifying the `config.ini` file in the `DevCore` directory. Configuration options include:

- **vendor_name**: Vendor name for the new library.
- **base_library_path**: Base path for the new library.
- **composer_json_path**: Path to the main `composer.json` file.

## Features

### `ScriptHandler` Class

The `ScriptHandler` class offers a set of methods for handling various Composer events. For example, `postAutoloadDump` generates a `config.ini` file and provides information about the setup.

Example:

```php
<?php

namespace Devinci\DevCore;

use Composer\Script\Event as ScriptEvent;

class ScriptHandler
{
    const INI_FILE = __DIR__ . '/config.ini';

    public static function postAutoloadDump(ScriptEvent $event)
    {
        // ... (see previous conversation for the complete method)
    }
}
```

## Example Usage

```php
<?php

namespace Devinci\DevCore;

class ScriptHandler
{
    const CONFIG_FILE = __DIR__ . '/../../config.php';

    public static function generateConfigPhp($vendorName, $libraryName)
    {
        // ... (see previous conversation for the complete method)
    }
}

// Usage in a script:
ScriptHandler::generateConfigPhp('devinci', 'dev-core');
```

## Contributing

If you encounter issues or have suggestions for improvements, feel free to open an issue or submit a pull request. We welcome contributions from the community.

## License

This library is licensed under the MIT License - see the [LICENSE](./LICENSE) file for details.
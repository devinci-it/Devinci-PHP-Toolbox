# Devinci Form Module

The Devinci Form Module provides a flexible and customizable solution for creating and processing HTML forms in PHP. It consists of two main components:

- **FormBuilder:** A class for creating HTML forms with ease and customization.
- **FormProcessor:** A class for processing form submissions, including data sanitization and validation.

## Usage: FormManager

The `FormManager` class is the primary interface for users to interact with when creating and processing HTML forms. Here's how you can use it:

### 1. Install the Module

Clone the repository or use your preferred method for including the module in your project.

```bash
git clone https://github.com/your-username/devinci-form-module.git
```

### 2. Create a Form Using FormManager

Use the `FormManager` class to create an HTML form by passing a configuration array. Here's an example:

```php
require_once "vendor/autoload.php";
use Devinci\FormManager\FormManager;

// Example form configuration
$formConfig = [
    'formAttributes' => ['action' => '', 'method' => 'POST'],
    'action' => 'process.php',
    'inputs' => [
        [
            'name' => 'username',
            'type' => 'text',
            'placeholder' => 'Username',
            'attributes' => ['required' => 'true', 'maxlength' => '50'],
        ],
        [
            'name' => 'password',
            'type' => 'password',
            'placeholder' => 'Password',
        ],
        // Add other input configurations as needed
    ],
    'submitButton' => [
        'name' => 'submitBtn',
        'value' => 'Submit',
        'attributes' => ['class' => 'submit-button'],
    ]
];

// Create an instance of FormManager
$formManager = new FormManager();

// Build the HTML form
$htmlForm = $formManager->buildForm($formConfig);

// Output the HTML form
echo $htmlForm;
```

### 3. Process Form Submissions

Simulate form submission and process the form data using the same `FormManager` instance:

```php
// Simulate form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formData = $_POST;
    $jsonResponse = $formManager->processForm($formData);
    echo $jsonResponse;
}
```


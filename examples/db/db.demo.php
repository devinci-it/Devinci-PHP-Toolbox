<?php

// Include the Composer autoload file
require_once "../vendor/autoload.php";

// Import the necessary class
use Devinci\FormCore\FormManager\FormManager;
use Devinci\UICore\Input\InputManager;


// Define the form configuration
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
            'attributes' => ['required' => 'true', 'maxlength' => '50'],
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

// Simulate form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the form data
    $formData = $_POST;

    // Process the form with FormManager
    $jsonResponse = $formManager->processForm($formData);

    // Output the JSON response
    echo $jsonResponse;
}

// Instructions for developers:
echo <<<'EOD'

----------------------------------------------
Instructions for Using the Form Demo Script:
----------------------------------------------

1. Clone or download the "Devinci PHP Toolbox" repository:
   https://github.com/your-username/Devinci-PHP-Toolbox

2. Install dependencies using Composer:
   ```bash
   composer install
   ```

3. Ensure that you have a web server (e.g., Apache) configured to serve the PHP files.

4. Run the demo script:
   - Open a terminal in the project root.
   - Execute the script using PHP:
     ```bash
     php form.demo.php
     ```

5. Access the form in your browser:
   - Open your web browser.
   - Visit the URL where your web server is serving the PHP files.

6. Interact with the form:
   - Fill in the form fields.
   - Click the "Submit" button.

7. View the simulated form submission:
   - Check the terminal where you executed the script to see the JSON response.

8. Explore and customize the FormManager class:
   - Refer to the FormManager class in "src/FormManager/FormManager.php" for more details.

EOD;

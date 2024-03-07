<?php

namespace Devinci\FormProcessor;
/**
 * FormProcessor class for sanitizing, validating, and processing form data.
 *
 * Properties:
 * - $formData (array): The form data to be processed.
 * - $result (string): The result of the form processing ('success' or 'error').
 *
 * Methods:
 * - __construct(array $formData = []): FormProcessor constructor.
 * - setFormData(array $formData): Set the form data for processing.
 * - sanitizeAndValidateFormData(array $data): Sanitize and validate the form data.
 * - sanitizeInput(mixed $input): Sanitize the input data.
 * - isValidInput(string $input): Check if the input is valid.
 * - processForm(): Process the form data and return a JSON response.
 * - printProcessedData(array $data): Print the processed form data.
 * - handleError(string $message): Handle errors during form processing.
 * - generateFormHandlerTemplate(string $directory, string $fileName): Generate a form handling template.
 *
 * Example Usage:
 * ```php
 * // Assuming autoloading is set up, and the necessary classes are correctly namespaced
 *
 * use Devinci\FormProcessor\FormProcessor;
 *
 * // Create an instance of FormProcessor with form data from POST
 * $formProcessor = new FormProcessor($_POST);
 *
 * // Process the form and get the JSON response
 * $jsonResponse = $formProcessor->processForm();
 *
 * // Output or use the generated JSON response as needed
 * echo $jsonResponse;
 * ```
 *
 * @package Devinci\FormProcessor
 */
class FormProcessor
{
    private $formData;
    private $result = 'success';

    /**
     * FormProcessor constructor.
     *
     * @param array $formData The form data to be processed (optional).
     */
    public function __construct(array $formData = [])
    {
        $this->formData = $formData;
    }

    /**
     * Set the form data for processing.
     *
     * @param array $formData The form data to be processed.
     *
     * @return FormProcessor Returns the current instance for method chaining.
     */
    public function setFormData($formData)
    {
        $this->formData = $formData;
        return $this;
    }

    /**
     * Sanitize and validate the form data.
     *
     * @param array $data The form data to be sanitized and validated.
     *
     * @return array The sanitized and validated form data.
     */
    private function sanitizeAndValidateFormData($data)
    {
        $sanitizedAndValidatedData = [];

        foreach ($data as $key => $value) {
            $sanitizedValue = $this->sanitizeInput($value);

            // Perform additional validation based on your requirements
            if ($this->isValidInput($sanitizedValue)) {
                $sanitizedAndValidatedData[$key] = $sanitizedValue;
            } else {
                $this->result = 'error';
                $this->handleError("Invalid input detected for key '$key'");
                $sanitizedAndValidatedData[$key] = ''; // Return empty string for invalid input
            }
        }

        return $sanitizedAndValidatedData;
    }

    /**
     * Sanitize the input data.
     *
     * @param mixed $input The input data to be sanitized.
     *
     * @return mixed The sanitized input data.
     */
    private function sanitizeInput($input)
    {
        // Example: Trim leading and trailing whitespaces
        $sanitizedInput = trim($input);

        // Add more sanitization steps as needed

        return $sanitizedInput;
    }

    /**
     * Check if the input is valid (free of dangerous characters).
     *
     * @param string $input The input to be validated.
     *
     * @return bool True if the input is valid; false otherwise.
     */
    private function isValidInput($input)
    {
        // Example: Check for dangerous characters and disallow them
        return !preg_match('/[<>\/\\\]/', $input);
    }

    /**
     * Process the form data and return a JSON response.
     *
     * @return string The JSON response from the FormProcessor.
     */
    public function processForm()
    {
        try {
            $processedData = $this->sanitizeAndValidateFormData($this->formData);
            // Perform additional processing logic here

            // For demonstration purposes, let's just print the processed data
            $this->printProcessedData($processedData);
        } catch (Exception $e) {
            $this->result = 'error';
            $this->handleError($e->getMessage());
        }

        // Return a JSON response
        $response = [
            'result' => $this->result,
            'data' => $processedData ?? null,
        ];

        return json_encode($response, JSON_PRETTY_PRINT);
    }

    /**
     * Print the processed form data.
     *
     * @param array $data The processed form data to be printed.
     */
    private function printProcessedData($data)
    {
        // For demonstration purposes, let's just print the processed data
        echo "Processed Form Data:\n";
        print_r($data);
    }

    /**
     * Handle errors during form processing.
     *
     * @param string $message The error message.
     */
    private function handleError($message)
    {
        // Handle the error as needed
        // Example: Log the error, send an email notification, etc.
        echo "Error: $message\n";
    }

    /**
     * Generate a form handling template and write it to the specified directory.
     *
     * @param string $directory The directory where the template will be written.
     * @param string $fileName  The name of the file to be generated.
     */
    public static function generateFormHandlerTemplate($directory, $fileName) {
        $template = <<<PHP
<?php

// Example form handling template generated by FormProcessor

// Instantiate the FormProcessor
\$formProcessor = new FormProcessor(\$_POST);

// Process the form
\$formProcessor->processForm();

PHP;

        // Write the template to the specified file
        file_put_contents("$directory/$fileName.php", $template);
    }
}

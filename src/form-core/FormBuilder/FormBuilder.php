<?php

namespace Devinci\FormCore\FormBuilder;

/**
 * FormBuilder class for creating HTML forms with ease and customization.
 *
 * Properties:
 * - $formAttributes (array): Associative array of form attributes (e.g., ['action' => '...', 'method' => '...']).
 * - $inputs (array): Array of input field configurations.
 * - $submitButton (array|null): Configuration for the submit button, if set.
 * - $clearButton (array|null): Configuration for the clear/reset button, if set.
 * - $action (string|null): The form submission action, if set.
 *
 * Methods:
 * - setFormAttributes(array $attributes): Set attributes for the form.
 * - addInput(string $name, string $type, string $placeholder, array $additionalAttributes = []): Add an input field to the form.
 * - setSubmitButton(string $name = 'submit', string $value = 'Submit', array $additionalAttributes = []): Set attributes for the submit button.
 * - setClearButton(string $name, string $value, array $additionalAttributes = []): Set attributes for the clear/reset button.
 * - setAction(string $action): Set the action attribute for the form.
 * - buildForm(): Build and echo the HTML form based on the configured settings.
 *
 * Example Usage:
 * ```php
 * // Assuming autoloading is set up, and the necessary classes are correctly namespaced
 *
 * use Devinci\FormBuilder\FormBuilder;
 *
 * // Create an instance of FormBuilder
 * $formBuilder = new FormBuilder();
 * $formBuilder->setFormAttributes(['action' => 'process.php', 'method' => 'POST'])
 *             ->addInput('username', 'text', 'Username', ['required' => 'true', 'maxlength' => '50'])
 *             ->addInput('password', 'password', 'Password')
 *             ->setSubmitButton('submit', 'Submit')
 *             ->setClearButton('clear', 'Clear')
 *             ->setAction('process.php')
 *             ->buildForm();
 * ```
 *
 * @package Devinci\FormBuilder
 */


class
FormBuilder
{
    private $formAttributes = [];
    private $inputs = [];
    private $submitButton;
    private $clearButton;
    private $action;

    /**
     * Set attributes for the form.
     *
     * @param array $attributes Associative array of form attributes (e.g., ['action' => '...', 'method' => '...']).
     *
     * @return FormBuilder Returns the current instance for method chaining.
     */
    public function setFormAttributes(array $attributes)
    {
        $this->formAttributes = $attributes;
        return $this;
    }

    /**
     * Add an input field to the form.
     *
     * @param string $name Name of the input field.
     * @param string $type Type of the input field (e.g., 'text', 'password').
     * @param string $placeholder Placeholder text for the input field.
     * @param array $additionalAttributes Additional attributes for the input field (optional).
     *
     * @return FormBuilder Returns the current instance for method chaining.
     */
    public function addInput($name, $type, $placeholder, array $additionalAttributes = [])
    {
        $this->inputs[] = [
            'name' => $name,
            'type' => $type,
            'placeholder' => $placeholder,
            'attributes' => $additionalAttributes,
        ];
        return $this;
    }

    /**
     * Set attributes for the submit button.
     *
     * @param string $name Name of the submit button (default: 'submit').
     * @param string $value Value displayed on the submit button (default: 'Submit').
     * @param array $additionalAttributes Additional attributes for the submit button (optional).
     *
     * @return FormBuilder Returns the current instance for method chaining.
     */
    public function setSubmitButton($name = 'submit', $value = 'Submit', array $additionalAttributes = [])
    {
        $this->submitButton = [
            'name' => $name,
            'value' => $value,
            'attributes' => $additionalAttributes,
        ];
        return $this;
    }


    /**
     * Set attributes for the clear/reset button.
     *
     * @param string $name Name of the clear/reset button.
     * @param string $value Value displayed on the clear/reset button.
     * @param array $additionalAttributes Additional attributes for the clear/reset button (optional).
     *
     * @return FormBuilder Returns the current instance for method chaining.
     */
    public function setClearButton($name, $value, array $additionalAttributes = [])
    {
        $this->clearButton = [
            'name' => $name,
            'value' => $value,
            'attributes' => $additionalAttributes,
        ];
        return $this;
    }

    /**
     * Set the action attribute for the form.
     *
     * @param string $action The form submission action (e.g., 'SignGuestBook.php').
     *
     * @return FormBuilder Returns the current instance for method chaining.
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
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
        if (is_array($input)) {
            // If the input is an array, recursively sanitize each element
            return array_map([$this, 'sanitizeInput'], $input);
        }

        // If the input is a string, trim leading and trailing whitespaces
        return is_string($input) ? trim($input) : $input;
    }

    /**
     * Build and echo the HTML form based on the configured settings.
     */
    public function buildForm()
    {
        echo '<form ';

        // Check if form attributes are set
        if ($this->formAttributes && is_array($this->formAttributes)) {
            foreach ($this->formAttributes as $key => $value) {
                // Ensure $value is a string before echoing
                echo $key . '="' . $this->sanitizeInput($value) . '" ';
            }
        }

        echo '>';
        foreach ($this->inputs as $input) {
            echo '<fieldset>';
            echo '<label for="' . $input['name'] . '" class="label">' . ucfirst($input['name']) . ':</label>';
            echo '<input placeholder="' . $this->sanitizeInput($input['placeholder']) . '" class="input-field" type="' . $this->sanitizeInput($input['type']) . '" id="' . $this->sanitizeInput($input['name']) . '" name="' . $this->sanitizeInput($input['name']) . '"';

            foreach ($input['attributes'] as $key => $value) {
                echo ' ' . $this->sanitizeInput($key) . '="' . $this->sanitizeInput($value) . '"';
            }

            echo '>';
            echo '</fieldset>';
        }

        echo '<input type="submit" name="' . $this->sanitizeInput($this->submitButton['name']) . '" class="submit-button" value="' . $this->sanitizeInput($this->submitButton['value']) . '"';

        foreach ($this->submitButton['attributes'] as $key => $value) {
            echo ' ' . $this->sanitizeInput($key) . '="' . $this->sanitizeInput($value) . '"';
        }

        echo '>';

        if ($this->clearButton) {
            echo '<input type="reset" name="' . $this->sanitizeInput($this->clearButton['name']) . '" class="clear-button" value="' . $this->sanitizeInput($this->clearButton['value']) . '"';

            foreach ($this->clearButton['attributes'] as $key => $value) {
                echo ' ' . $this->sanitizeInput($key) . '="' . $this->sanitizeInput($value) . '"';
            }

            echo '>';
        }

        echo '</form>';
    }
}

// Example usage with chaining:
/*
$formBuilder = new FormBuilder();
$formBuilder->setFormAttributes(['action' => 'SignGuestBook.php', 'method' => 'POST'])
    ->addInput('firstName', 'text', 'First Name')
    ->addInput('lastName', 'text', 'Last Name')
    ->setSubmitButton('Submit', 'Sign')
    ->setClearButton('Clear', 'Clear')
    ->setAction('SignGuestBook.php')
    ->buildForm();
*/
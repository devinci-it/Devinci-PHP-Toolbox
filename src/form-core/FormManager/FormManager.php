<?php

namespace Devinci\FormCore\FormManager;

use Devinci\FormCore\FormBuilder\FormBuilder;
use Devinci\FormCore\FormProcessor\FormProcessor;

/**
 * Class FormManager
 *
 * Manages the creation and processing of HTML forms using FormBuilder and FormProcessor.
 */
class FormManager {
    private $formBuilder;
    private $formProcessor;

    /**
     * FormManager constructor.
     *
     * Initializes the FormManager with instances of FormBuilder and FormProcessor.
     */
    public function __construct() {
        $this->formBuilder = new FormBuilder();
        $this->formProcessor = new FormProcessor();
    }

    /**
     * Process the form configuration array or input configuration.
     *
     * @param array $config The form configuration array or input configuration.
     *
     * @return array Processed form configuration.
     */
    private function processFormConfig(array $config) {
        $defaultConfig = [
            'formAttributes' => ['action' => 'process.php', 'method' => 'POST'],
            'inputs' => [],
        ];

        $processedConfig = $config + $defaultConfig;

        return $processedConfig;
    }


// Inside the FormManager class

    /**
     * Build a form using the FormBuilder.
     *
     * @param array $formConfig The configuration array for building the form.
     *
     * @return string The HTML representation of the form.
     */
    public function buildForm(array $formConfig) {
        $processedConfig = $this->processFormConfig($formConfig);

        $this->formBuilder
            ->setFormAttributes($processedConfig['formAttributes']);

        // Check if a submit button is configured
        $hasSubmitButton = false;

        foreach ($processedConfig['inputs'] as $inputConfig) {
            if ($inputConfig['type'] === 'submit') {
                $hasSubmitButton = true;
                break;
            }
        }

        // If no submit button is configured, set a default one
        if (!$hasSubmitButton) {
            $this->formBuilder->setSubmitButton('Submit', 'Submit');
        }

        foreach ($processedConfig['inputs'] as $inputConfig) {
            $this->formBuilder->addInput(
                $inputConfig['name'],
                $inputConfig['type'],
                $inputConfig['placeholder'],
                $inputConfig['attributes'] ?? []
            );
        }

        return $this->formBuilder->buildForm();
    }


    /**
     * Process a form submission using the FormProcessor.
     *
     * @param array $formData The form data submitted for processing.
     *
     * @return string The JSON response from the FormProcessor.
     */
    public function processForm(array $formData) {
        $this->formProcessor
            ->setFormData($formData);

        $jsonResponse = $this->formProcessor->processForm();

        return $jsonResponse;
    }

    /**
     * Set attributes for the submit button.
     *
     * @param string $name Name of the submit button.
     * @param string $value Value displayed on the submit button.
     * @param array $additionalAttributes Additional attributes for the submit button (optional).
     *
     * @return FormManager Returns the current instance for method chaining.
     */
    public function setSubmitButton($name, $value, array $additionalAttributes = []) {
        $this->formBuilder->setSubmitButton($name, $value, $additionalAttributes);
        return $this;
    }
}

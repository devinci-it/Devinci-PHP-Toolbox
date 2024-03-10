<?php

namespace Devinci\UICore\ImageInput;

use Devinci\UICore\Input\Input;


class ImageInput extends Input
{
    /**
     * ImageInput class extends the Input class and represents an HTML input element specifically designed for image uploads.
     *
     * This class provides methods to customize the accepted file extensions and upload directory for image files.
     * It generates the corresponding HTML markup for an image input field with optional labeling and additional attributes.
     *
     * @package Devinci\UICore\ImageInput
     */

    protected $acceptedExtensions = [];
    protected $uploadDirectory = '';

    protected $dynamicInputAddition;

    public function __construct(ImageInputBuilder $builder)
    {
        // Call the constructor of the parent class
        parent::__construct($builder);

        // Additional code specific to ImageInput
        $this->dynamicInputAddition = $builder->isDynamicInputAddition();
    }

    public function generate(): string
    {
        $lowercasePlaceholder = $this->generatePlaceholder();
        $attributesString = $this->buildAttributesString();
        $accept = implode(',', $this->acceptedExtensions);

        $html = '<div class="image-input-container">';

        if ($this->isLabeled) {
            $html .= '<label for="' . $this->attributes['id'] . '">' . $this->typeName . '</label>';
        }

        $html .= '<div class="input-wrapper">';
        $html .= '<input id="' . $this->attributes['id'] . '" class="input form-input" name="' . $this->name . '" type="' . $this->typeName . '" placeholder="' . $this->placeholder . '" required ' . $attributesString . ' accept="' . $accept . '">';

        // Add JavaScript for adding more images dynamically
//        $html .= '<button type="button" class="btn btn-success add-image-btn" onclick="addImageInput()">Add Image</button>';

        $html .= '</div></div>';
        if ($this->dynamicInputAddition) {
            $html .= $this->renderImageInputScript($accept);
            $html .= '<button type="button" class="btn btn-primary add-image-btn" onclick="addImageInput()">Add Image</button>';
        }
        return $html;
    }

protected function renderImageInputScript($accept)
{
    return '<script>
        function addImageInput() {
            var container = document.querySelector(\'.image-input-container\');
            
            // Create a wrapper div for each image input and delete button
            var wrapper = document.createElement(\'div\');
            wrapper.className = \'image-input-wrapper\';
            
            // Create the input element
            var input = document.createElement(\'input\');
            input.type = \'file\';
            input.name = \'' . $this->name . '_add[]\';
            input.className = \'input form-input\';
            input.accept = \'' . $accept . '\';
            
            // Create the delete button
            var deleteBtn = document.createElement(\'button\');
            deleteBtn.type = \'button\';
            deleteBtn.className = \'btn btn-danger delete-image-btn\';
            deleteBtn.innerText = \'Delete\';
            
            // Add click event to delete button
            deleteBtn.addEventListener(\'click\', function() {
                container.removeChild(wrapper);
            });
            
            // Append input and delete button to wrapper
            wrapper.appendChild(input);
            wrapper.appendChild(deleteBtn);
            
            // Append wrapper to container
            container.appendChild(wrapper);
        }
    </script>';
}


}

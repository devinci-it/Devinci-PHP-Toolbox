<?php
namespace Devinci\UICore\ImageInput;

class ImagePreviewer
{
    /**
     * ImagePreviewer class provides a static method to render an image preview based on the configuration of an ImageInputBuilder instance.
     *
     * Properties:
     * - None in this class, as it primarily utilizes the properties of the provided ImageInputBuilder instance.

     * Methods:
     * - renderPreview(ImageInputBuilder $imageInput): string
     *   Renders and returns HTML markup for displaying an image preview.
     *   The method dynamically updates the preview when an image is selected using JavaScript.
     *
     * Example Usage:
     * ```php
     * // Assuming autoloading is set up, and the necessary classes are correctly namespaced
     *
     * use Devinci\UICore\ImageInput\ImageInputBuilder;
     * use Devinci\UICore\ImageInput\ImagePreviewer;
     *
     * // Create an instance of ImageInputBuilder
     * $imageInputBuilder = new ImageInputBuilder();
     * $imageInputBuilder->setAcceptedExtensions(['jpg', 'png', 'gif'])
     *                   ->setPlaceholderPath('path/to/custom/placeholder.svg');
     *
     * // Render HTML for the image input
     * $imageInputHtml = $imageInputBuilder->build()->generate();
     *
     * // Render HTML for the image preview using ImagePreviewer
     * $imagePreviewHtml = ImagePreviewer::renderPreview($imageInputBuilder);
     *
     * // Output or use the generated HTML as needed
     * echo $imageInputHtml;
     * echo $imagePreviewHtml;
     * ```
     *
     * @package Devinci\UICore\ImageInput
     */

    public static function renderPreview(ImageInputBuilder $imageInput): string
    {
        $inputName = $imageInput->getName();
        $placeholderPath = $imageInput->getPlaceholder();
        $inputIdArray = $imageInput->getAttributes();
        $inputId=$inputIdArray['id']??$inputName;



        $html = '<div class="image-preview-container" onclick="triggerInput(\'' . $inputId . '\')">';
        $html .= '<img src="' . $placeholderPath . '" alt="No Image Uploaded" id="preview_' . $inputName . '" class="image-preview">';
        $html .= '</div>';


        $html .= '<script>';
        $html .= 'function triggerInput(inputId) {';
        $html .= '    var input = document.getElementById(inputId);';
        $html .= '    input.click();';
        $html .= '}';
        $html .= 'function hideInput(inputId) {';
        $html .= '    var input = document.getElementById(inputId);';
        $html .= '    input.style.display = "none";'; // Set the style to hidden
        $html .= '}';
        $html .= 'document.getElementById("'.$inputName.'").addEventListener("change", function(event) { renderImagePreview(event, "'.$inputName.'"); });';
        $html .= 'function renderImagePreview(event, inputName) {';
        $html .= '    var files = event.target.files;';
        $html .= '  hideInput(inputName); ';
        $html .= '    var previewImage = document.getElementById("preview_" + inputName);';
        $html .= '    if (files.length > 0) {';
        $html .= '        var reader = new FileReader();';
        $html .= '        reader.onload = function(e) {';
        $html .= '            previewImage.src = e.target.result;';
        $html .= '        };';
        $html .= '        reader.readAsDataURL(files[0]);';
        $html .= '    } else {';
        $html .= '        previewImage.src = "' . $placeholderPath . '";';
        $html .= '    }';
        $html .= '}';
        $html .= '</script>';

        return $html;
    }
}

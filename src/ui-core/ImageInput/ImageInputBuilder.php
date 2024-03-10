<?php
/**
 * ImageInputBuilder class extends the InputBuilder class and is responsible for constructing instances of the ImageInput class.
 *
 * It facilitates the configuration of an image input, allowing customization of accepted file extensions,
 * preview visibility, and the path to the placeholder image.
 *
 * Properties:
 * - array $acceptedExtensions: An array specifying the accepted file extensions for image uploads.
 * - bool $showPreview: A boolean indicating whether to display a preview for the selected image.
 * - string $placeholderPath: The file path to the placeholder image displayed when no image is selected.
 *
 * Methods:
 * - setAcceptedExtensions(array $acceptedExtensions): Set the accepted file extensions and return the builder instance.
 * - setShowPreview(bool $showPreview): Set the preview visibility and return the builder instance.
 * - setPlaceholderPath(string $path): Set the path for the placeholder image and return the builder instance.
 * - build(): Create and return a new ImageInput instance with the configured settings.
 *
 * Example Usage:
 * ```php
 * // Assuming autoloading is set up, and the necessary classes are correctly namespaced
 *
 * use Devinci\UICore\ImageInput\ImageInputBuilder;
 *
 * // Create an instance of ImageInputBuilder
 * $imageInputBuilder = new ImageInputBuilder();
 *
 * // Customize the builder as needed
 * $imageInputBuilder
 *     ->setAcceptedExtensions(['jpg', 'png', 'gif'])
 *     ->setPlaceholderPath('path/to/custom/placeholder.svg')
 *     ->setShowPreview(true);
 *
 * // Build the ImageInput instance
 * $imageInput = $imageInputBuilder->build();
 *
 * // Generate HTML for the image input
 * $html = $imageInput->generate();
 *
 * // Output or use the generated HTML as needed
 * echo $html;
 * ```
 *
 * @package Devinci\UICore\ImageInput
 */

namespace Devinci\UICore\ImageInput;

use Devinci\UICore\Input\InputBuilder;

class ImageInputBuilder extends InputBuilder
{
public array $acceptedExtensions = [];
public bool $showPreview = false;
public string $placeholderPath = 'static/assets/pholder.svg';

private bool $dynamicInputAddition = false;

public function setDynamicInputAddition(bool $value): self
{
    $this->dynamicInputAddition = $value;
    return $this;
}

public function isDynamicInputAddition(): bool
{
    return $this->dynamicInputAddition;
}

public function setAcceptedExtensions(array $acceptedExtensions): self
{
$this->acceptedExtensions = $acceptedExtensions;
return $this;
}


public function setPlaceholderPath(string $path): self
{
$this->placeholderPath = $path;
return $this;
}





public function build(): ImageInput
{
return new ImageInput($this);
}
}

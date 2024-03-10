# ImageInput Package

The `ImageInput` package provides a set of classes for creating and managing HTML input elements tailored for image uploads, along with a utility for rendering image previews.

## ImageInput Class

### Description

The `ImageInput` class extends the base `Input` class and represents an HTML input element specifically designed for image uploads. It includes methods to customize accepted file extensions and the upload directory, generating HTML markup for an image input field.

### Properties

- `protected $acceptedExtensions`: An array specifying the accepted file extensions for image uploads.
- `protected $uploadDirectory`: A string representing the directory where uploaded images will be stored.

### Methods

- `setAcceptedExtensions(array $acceptedExtensions): self`: Set the accepted file extensions and return the class instance.
- `setUploadDirectory(string $uploadDirectory): self`: Set the upload directory and return the class instance.
- `generate(): string`: Generate HTML markup for the image input element.

## ImageInputBuilder Class

### Description

The `ImageInputBuilder` class extends the `InputBuilder` class and is responsible for constructing instances of the `ImageInput` class. It allows customization of accepted file extensions, preview visibility, and placeholder image path.

### Properties

- `public array $acceptedExtensions`: An array specifying the accepted file extensions for image uploads.
- `public bool $showPreview`: A boolean indicating whether to display a preview for the selected image.
- `public string $placeholderPath`: The file path to the placeholder image displayed when no image is selected.

### Methods

- `setAcceptedExtensions(array $acceptedExtensions): self`: Set the accepted file extensions and return the builder instance.
- `setShowPreview(bool $showPreview): self`: Set the preview visibility and return the builder instance.
- `setPlaceholderPath(string $path): self`: Set the path for the placeholder image and return the builder instance.
- `build(): ImageInput`: Create and return a new `ImageInput` instance with the configured settings.

### Example Usage

```php
// Assuming autoloading is set up, and the necessary classes are correctly namespaced

use ImageInput\ImageInputBuilder;

// Create an instance of ImageInputBuilder
$imageInputBuilder = new ImageInputBuilder();

// Customize the builder as needed
$imageInputBuilder
    ->setAcceptedExtensions(['jpg', 'png', 'gif'])
    ->setPlaceholderPath('path/to/custom/placeholder.svg')
    ->setShowPreview(true);

// Build the ImageInput instance
$imageInput = $imageInputBuilder->build();

// Generate HTML for the image input
$html = $imageInput->generate();

// Output or use the generated HTML as needed
echo $html;
```

## ImagePreviewer Class

### Description

The `ImagePreviewer` class provides a static method to render an image preview based on the configuration of an `ImageInputBuilder` instance. It generates HTML markup for displaying an image preview and includes JavaScript for dynamically updating the preview when an image is selected.

### Methods

- `renderPreview(ImageInputBuilder $imageInput): string`: Render and return HTML markup for displaying an image preview.

### Example Usage

```php
// Assuming autoloading is set up, and the necessary classes are correctly namespaced

use ImageInput\ImageInputBuilder;use ImageInput\ImagePreviewer;

// Create an instance of ImageInputBuilder
$imageInputBuilder = new ImageInputBuilder();
$imageInputBuilder->setAcceptedExtensions(['jpg', 'png', 'gif'])
                  ->setPlaceholderPath('path/to/custom/placeholder.svg');

// Render HTML for the image input
$imageInputHtml = $imageInputBuilder->build()->generate();

// Render HTML for the image preview using ImagePreviewer
$imagePreviewHtml = ImagePreviewer::renderPreview($imageInputBuilder);

// Output or use the generated HTML as needed
echo $imageInputHtml;
echo $imagePreviewHtml;
```

## Installation

To use this package, ensure that autoloading is set up correctly, and the necessary classes are correctly namespaced.

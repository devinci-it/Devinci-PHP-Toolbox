<?php

namespace Devinci\UICore\Input;


class Input
{
    protected $attributes;
    protected $name;
    protected $isLabeled;
    protected $typeName;
    protected $isError;
    protected $stickyValue;
    protected $placeholder;

    public function __construct(InputBuilder $builder)
    {
        $this->attributes = $builder->getAttributes();
        $this->name = $builder->getName();
        $this->isLabeled = $builder->isLabeled();
        $this->typeName = $builder->getTypeName();
        $this->isError = $builder->isError();
        $this->stickyValue = $builder->getStickyValue();
        $this->placeholder = $builder->getPlaceholder();


        // Set id if not present, defaulting to name
        $this->attributes['id'] = $this->attributes['id'] ?? $this->name;
    }

    public function generate(): string
    {
        $lowercasePlaceholder = $this->generatePlaceholder();
        $attributesString = $this->buildAttributesString();
        $html = '<div class="input-container">';

        if ($this->isLabeled) {
            $html .= '<label for="' . $this->attributes['id'] . '">' . $this->typeName . '</label>';
        }

        $html .= '<div class="input-wrapper">';
        if ($this->typeName === 'textarea') {
            $html .= '<textarea id="' . $this->attributes['id'] . '" name="' . $this->name . '" class="input form-input" placeholder="' . $this->placeholder . '" required ' . $attributesString . ' style="width: 100%; resize: vertical;" rows="4">';
            $html .= htmlspecialchars($this->stickyValue);
            $html .= '</textarea>';
        } else {
            // Render input for other types
            $html .= '<input id="' . $this->attributes['id'] . '" value="' . htmlspecialchars($this->stickyValue) . '" class="input form-input" name="' . $this->name . '" type="' . $this->typeName . '" placeholder="' . $this->placeholder . '" required ' . $attributesString . '>';
        }
//        $html .= '<input id="' . $this->attributes['id'] . '" value="' . htmlspecialchars($this->stickyValue) . '" class="input form-input" name="' . $this->name . '" type="' . $this->typeName . '" placeholder="' . $this->placeholder . '" required ' . $attributesString . '>';
        $html .= '</div></div>';

        return $html;
    }

    public function generatePlaceholder()
    {
        if ($this->placeholder !== null) {
            return strtolower(str_replace(' ', '_', $this->placeholder));
        }

        return strtolower(str_replace(' ', '_', $this->name));
    }

    protected function buildAttributesString(): string
    {
        $attributesString = '';

        foreach ($this->attributes as $name => $value) {
            // Check if the attribute value is an array
            if (is_array($value)) {
                // Handle arrays as needed, for example, implode them
                $value = implode(' ', $value);
            }

            // Escape and concatenate the attribute name and value
            $attributesString .= ' ' . htmlspecialchars($name, ENT_QUOTES, 'UTF-8') . '="' . htmlspecialchars($value, ENT_QUOTES, 'UTF-8') . '"';
        }

        return $attributesString;
    }
}

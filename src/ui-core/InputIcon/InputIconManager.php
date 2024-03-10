<?php

namespace Devinci\UICore\InputIcon;

class InputIconManager
{
    private $inputIconBuilder;

    public function __construct()
    {
        $this->inputIconBuilder = new InputIconBuilder();
    }

    public function createInputIcon($name, $svgFilename, $isLabeled, $typeName, $isError, $stickyValue, $placeholder, $attributes = []): InputIcon
    {
        return $this->inputIconBuilder
            ->setName($name)
            ->setSvgFilename($svgFilename)
            ->setIsLabeled($isLabeled)
            ->setTypeName($typeName)
            ->setIsError($isError)
            ->setStickyValue($stickyValue)
            ->setPlaceholder($placeholder)
            ->setAttributes($attributes)
            ->build();
    }

    public function renderInputIcon(InputIcon $inputIcon): string
    {
        return $inputIcon->generate();
    }
}

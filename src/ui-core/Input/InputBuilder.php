<?php

namespace Devinci\UICore\Input;

class InputBuilder
{

    protected mixed $attributes = [];
    protected $name='';
    protected $isLabeled = false;
    protected $typeName = 'text';
    protected $isError = false;
    protected $stickyValue = '';
    protected $placeholder = '';


    /*
     * Getters
     */
    /**
     * @return mixed
     */
    public function getAttributes(): mixed
    {
        return $this->attributes;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isLabeled(): bool
    {
        return $this->isLabeled;
    }

    /**
     * @return string
     */
    public function getTypeName(): string
    {
        return $this->typeName;
    }

    /**
     * @return bool
     */
    public function isError(): bool
    {
        return $this->isError;
    }


    /**
     * @return string
     */
    public function getPlaceholder(): string
    {
        return $this->placeholder;
    }
    public function getStickyValue(): string
    {
        return $this->stickyValue ?? ''; // Ensure a default value is returned
    }
    public function setName($name): self
    {
        $this->name = $name;
        return $this;
    }

    public function setIsLabeled($isLabeled): self
    {
        $this->isLabeled = $isLabeled;
        return $this;
    }

    public function setTypeName($typeName): self
    {
        $this->typeName = $typeName;
        return $this;
    }

    public function setIsError($isError): self
    {
        $this->isError = $isError;
        return $this;
    }

    public function setStickyValue($stickyValue): self
    {
        $this->stickyValue = $stickyValue;
        return $this;
    }

    public function setPlaceholder($placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function setAttributes($attributes): self
    {
        $this->attributes = $attributes;
        return $this;
    }

    public function build(): Input
    {
        return new Input($this);
    }
}


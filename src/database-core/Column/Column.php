<?php

namespace Devinci\DatabaseCore\Column;


class Column
{
    private $name;
    private $type;
    private $attributes;

    public function __construct($name, $type, $attributes = '')
    {
        $this->name = $name;
        $this->type = $type;
        $this->attributes = $attributes;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function hasAttributes()
    {
        return !empty($this->attributes);
    }
}

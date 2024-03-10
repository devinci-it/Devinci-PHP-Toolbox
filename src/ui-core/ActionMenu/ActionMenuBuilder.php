<?php

namespace Devinci\UICore\ActionMenu;

class ActionMenuBuilder
{
    private $actions;
    private $iconPath; // New property to store the icon path

    public function __construct($actions)
    {
        $this->actions = $actions;
        $this->iconPath = ''; // Initialize the icon path to an empty string
    }

    // Method to set the icon path
    public function setIconPath($iconPath)
    {
        $this->iconPath = $iconPath;
        return $this; // Allow chaining
    }

    public function build()
    {
        // Create an instance of ActionMenu with the actions and icon path
        $actionMenu = new ActionMenu($this->actions, $this->iconPath);
        return $actionMenu;
    }
}

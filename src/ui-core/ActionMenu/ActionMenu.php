<?php

namespace Devinci\UICore\ActionMenu;

class ActionMenu
{
    private $actions;
    private $iconPath; // New property to store the icon path

    public function __construct($actions, $iconPath = '')
    {
        $this->actions = $actions;
        $this->iconPath = $iconPath; // Set the provided icon path
    }

    // Method to set the icon path
    public function setIconPath($iconPath)
    {
        $this->iconPath = $iconPath;
        return $this; // Allow chaining
    }

    public function render()
    {
        echo '<div class="action-menu">';
        foreach ($this->actions as $action) {
            $link = $action['path'] . '?action=' . urlencode($action['name']);
            echo '<a href="' . $link . '" class="btn action-btn">';
            echo '<img src="' . $this->iconPath . $action['icon'] . '" alt="' . $action['name'] . '" class="menu-icon">';
            echo $action['name'];
            echo '</a>';
        }
        echo '</div>';
    }

    public function addAction($name, $path, $icon)
    {
        $this->actions[] = ['name' => $name, 'path' => $path, 'icon' => $icon];
        return $this; // Allow chaining
    }

    // Setters for individual properties
    public function setName($index, $name)
    {
        $this->actions[$index]['name'] = $name;
        return $this; // Allow chaining
    }

    public function setPath($index, $path)
    {
        $this->actions[$index]['path'] = $path;
        return $this; // Allow chaining
    }

    public function setIcon($index, $icon)
    {
        $this->actions[$index]['icon'] = $icon;
        return $this; // Allow chaining
    }
}

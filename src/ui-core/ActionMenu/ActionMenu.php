<?php
namespace Devinci\UICore\ActionMenu;

class ActionMenu
{
    private $actions;

    public function __construct($actions)
    {
        $this->actions = $actions;
    }

    public function render()
    {
        echo '<div class="action-menu">';
        foreach ($this->actions as $action) {
            $link = $action['path'] . '?action=' . urlencode($action['name']);
            echo '<a href="' . $link . '" class="btn action-btn">';
            echo '<img src="' . $action['icon'] . '" alt="' . $action['name'] . '" class="menu-icon">';
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
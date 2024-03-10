<?php

namespace Devinci\UICore\SideBar;

class Sidebar
{
    protected $activeTab;
    protected $navItems = [];
    private $isExpanded;

    public function __construct($isExpanded = true)
    {
        $this->isExpanded = $isExpanded;
        include_once "SidebarItem.php";
    }

    public function addMenu($name, $items)
    {
        $this->navItems[$name] = $items;
        return $this;
    }

    public function generateSidePanel($menuArray)
    {
        $returnSidePanel = '';

        foreach ($menuArray as $label => $menuItemData) {
            list($menuItem, $iconPath, $hashLink) = $menuItemData;

            $returnSidePanel .= $this->generateSidebarItem($label, $hashLink, $iconPath, strtolower($this->activeTab) == strtolower($label) ? 'active' : '');
        }
        return $returnSidePanel;
    }

    public function generateSidebarItem($label, $href, $icon, $class = null)
    {
        $iconPath =  "static/assets/nav/" . $icon;
        $classAttribute = $class ?? '';

        $classAttribute = $class ?? ''; // Check if class is not null
        return '<li class="side-menu-item ' . $classAttribute . '">
<a class="caption-text" href="' . $href . '">
<img src="' . $iconPath . '" alt="' . $label . ' Icon">' . $label . '</a></li>';
    }

    public function render($active)
    {
        $this->activeTab = strtolower($active);

        foreach ($this->navItems as $menuName => $menuArray) {
            echo '<div class="';
            echo $this->isExpanded ? 'icon-sidebar' : 'panel-group body-medium-text';
            echo '">';
            echo '<ul class="sidebar-list">'; // Start the list
            echo $this->generateSidePanel($menuArray);
            echo '</ul>'; // End the list
            echo '</div>';
        }
    }
}


<?php

namespace Devinci\UICore\SideBar;

class SidebarBuilder
{
    private $sidebar;

    public function __construct($isExpanded = true)
    {
        $this->sidebar = new Sidebar($isExpanded);
    }

    public function addMenu($name, $items)
    {
        $this->sidebar->addMenu($name, $items);
        return $this;
    }

    public function build()
    {
        return $this->sidebar;
    }
}

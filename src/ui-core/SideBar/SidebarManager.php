<?php
namespace Devinci\UICore\SideBar;

class SidebarManager
{
    private $sidebar;

    public function __construct(Sidebar $sidebar)
    {
        $this->sidebar = $sidebar;
    }

    public function render($active)
    {
        $this->sidebar->render($active);
    }
}

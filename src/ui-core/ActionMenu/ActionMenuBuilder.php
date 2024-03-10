<?php

namespace Devinci\UICore\ActionMenu;

class ActionMenuBuilder
{
private $actions;

public function __construct($actions)
{
$this->actions = $actions;
}

public function build()
{
$actionMenu = new ActionMenu($this->actions);
return $actionMenu;
}
}

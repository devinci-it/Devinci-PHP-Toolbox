<?php

namespace Devinci\UICore\Input;

class InputManager
{
    public function renderInput(Input $input): string
    {
        return $input->generate();
    }
}

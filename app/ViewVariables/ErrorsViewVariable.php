<?php

namespace App\ViewVariables;

class ErrorsViewVariable implements ViewVariables
{
    public function getName():string
    {
        return 'error';
    }

    public function getValue(): array
    {
        return $_SESSION['errors'] ?? [];
    }
}
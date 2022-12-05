<?php

namespace App\Controllers;

use App\Services\ForgotPasswordService;
use App\Template;

class ForgotPasswordController
{
    public function showForm(): Template
    {
        return new Template('/views/forgotPassword.twig');
    }

    public function recreatePassword()
    {
        $forgotPasswordService = new ForgotPasswordService();

    }
}
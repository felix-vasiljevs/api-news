<?php

namespace App\Controllers;

use App\Template;

class ChangeEmailController
{
    public function showForm(): Template
    {
        return new Template('/changeEmail');
    }

    public function changeEmail()
    {
        if (!$_POST['email']) {
            return new Template('login.twig', ['password' => false]);
        }
        $loginService = new LoginService();
        $loginService->execute(
            new LoginServiceRequest(
                $_POST['email'],
                $_POST['password']
            )
        );
        return new Template('views/login.twig');
    }
}
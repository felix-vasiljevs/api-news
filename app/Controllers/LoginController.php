<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\LoginService;
use App\Services\LoginServiceRequest;
use App\Template;

class LoginController
{
    public function showForm(): Template
    {
        return new Template('login.twig');
    }

    public function logIn(): Redirect
    {
        $loginService = new LoginService();
        $loginService->execute(
            new LoginServiceRequest(
                $_POST['email'],
                $_POST['password']
            )
        );

        if (!$_POST['email'] || !$_POST['password']) {
            return new Redirect('login.twig');
        }

        return new Redirect('/');
    }
}
<?php

namespace App\Controllers;

use App\Services\LoginService;
use App\Services\LoginServiceRequest;
use App\Template;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class LoginController
{
    public function showForm(): Template
    {
        return new Template('login.twig');
    }

    public function logIn(): Template
    {
        if (!$_POST['password']) {
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

    public function sessionStart()
    {
        $loader = new FilesystemLoader('../views');

        $twig = new Environment($loader);
        $twig->addGlobal('session', $_SESSION['id']);
    }
}
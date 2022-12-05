<?php

namespace App\Controllers;

use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;

class RegisterController
{
    public function showForm(): Template
    {
        // parāda lauciņus kurus vajag aizpildīt
        return new Template('register.twig');
    }

    public function store(): Template
    {
        if ($_POST['email'] === $_ENV[''])

        if ($_POST['password'] !== $_POST['confirmedPassword']) {
            return new Template('register.twig', ['confirmedPassword' => false]);
        }
        // using $_POST deal with the registration
        $registerService = new RegisterService();
        $registerService->execute(
            new RegisterServiceRequest(
                $_POST['name'],
                $_POST['email'],
                $_POST['password'],
                $_POST['confirmedPassword'],
            )
        );

        return new Template('/views/register.twig');
        //  header() + location
    }
}
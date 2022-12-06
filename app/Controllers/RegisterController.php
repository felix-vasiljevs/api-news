<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\RegisterService;
use App\Services\RegisterServiceRequest;
use App\Template;
use App\Validation;

class RegisterController
{
    public function showForm(): Template
    {
        return new Template('register.twig');
    }

    public function store(): Redirect
    {
        // TODO: Create validation
        $_SESSION['auth_id'] = 1;
        // where
        // what
        // how the f*** i can render it

        (new Validation())->validate($_POST);
        $validation = new Validation();
        $validation->validate($_POST);

        if ($validation->failed()) {
            return new Redirect('/register');
        }

        if ($_POST['password'] !== $_POST['confirmedPassword']) {
            return new Redirect('/register');
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

        return new Redirect('/login');
        //  header() + location
    }
}
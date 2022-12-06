<?php

namespace App\Controllers;

use App\Redirect;
use App\Services\ForgotPasswordRequest;
use App\Services\ForgotPasswordService;
use App\Template;
use App\Validation;

class ForgotPasswordController
{
    public function showForm(): Template
    {
        return new Template('/forgotPassword');
    }

    public function recreatePassword(): Redirect
    {
        $_SESSION['auth_id'] = 1;

        (new Validation())->validate($_POST);
        $validation = new Validation();
        $validation->validate($_POST);

        if ($validation->failed()) {
            return new Redirect('/forgotPassword');
        }

        if ($_POST['password'] !== $_POST['confirmedPassword']) {
            return new Redirect('/register');
        }

        // using $_POST deal with the registration
        $forgotPasswordService = new ForgotPasswordService();
        $forgotPasswordService->execute(
            new ForgotPasswordRequest(
                $_POST['email'],
                $_POST['password'],
                $_POST['confirmedPassword'],
            )
        );
        return new Redirect('/');
    }
}
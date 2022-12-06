<?php

namespace App\Services;

class ForgotPasswordRequest
{
    private string $email;
    private string $password;
    private string $confirmPassword;

    public function __construct(
        string $email,
        string $password,
        string $confirmPassword
    )
    {
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmPassword(): string
    {
        return $this->confirmPassword;
    }
}
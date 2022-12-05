<?php

namespace App\Services;

class RegisterServiceRequest
{
    private string $name;
    private string $email;
    private string $password;
    private string $confirmPassword;

    public function __construct(string $name, string $email, string $password, string $confirmPassword)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
        $this->confirmPassword = $confirmPassword;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getConfirmedPassword(): string
    {
        return $this->confirmPassword;
    }
}
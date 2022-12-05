<?php

namespace App\Models;

class User
{
    private string $name;
    private string $userName;
    private string $email;
    private string $password;

    public function __construct(
        string $name,
        string $userName,
        string $email,
        string $password
    )
    {
        $this->name = $name;
        $this->userName = $userName;
        $this->email = $email;
        $this->password = $password;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getUserName(): string
    {
        return $this->userName;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
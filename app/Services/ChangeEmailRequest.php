<?php

namespace App\Services;

class ChangeEmailRequest
{
    private string $currentEmail;
    private string $newEmail;
    private string $password;

    public function __construct(
        string $currentEmail,
        string $newEmail,
        string $password
    )
    {
        $this->currentEmail = $currentEmail;
        $this->newEmail = $newEmail;
        $this->password = $password;
    }

    public function getCurrentEmail(): string
    {
        return $this->currentEmail;
    }

    public function getNewEmail(): string
    {
        return $this->newEmail;
    }

    public function getPassword(): string
    {
        return $this->password;
    }
}
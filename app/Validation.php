<?php

namespace App;

class Validation
{
    public function failed(): bool
    {
        return count($_SESSION['errors']) > 0;
    }

    public function validate(array $post): Validation
    {
        $this->validatePassword($post['password']);
        $this->validateEmail($post['email']);

        if (strlen($post['name']) < 5) {
            $_SESSION['errors']['name'] = 'Password must be at least 5 symbols.';
        }

        return $this;
    }

    private function validatePassword(array $post): Validation
    {
        if ($post['password'] !== $_POST['confirmedPassword']) {
            $_SESSION['errors']['password'] = 'Password does not match confirmation.';
        }

        if (strlen($post['password']) < 5) {
            $_SESSION['errors']['password'] = 'Password must be at least 5 symbols.';
        }
        return $this;
    }

    private function validateEmail(array $post): Validation
    {
        if ($post['email'] !== $_POST['email']) {
            $_SESSION['errors']['email'] = 'Password does not match confirmation.';
        }
        return $this;
    }
}
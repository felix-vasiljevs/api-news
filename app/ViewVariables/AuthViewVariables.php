<?php

namespace App\ViewVariables;

use App\DataBase;

class AuthViewVariables implements ViewVariables
{
    public function getName(): string
    {
        return 'auth';
    }

    public function getValue(): array
    {
        if (!isset($_SESSION['auth'])) {
            return [];
        }

        // SELECT * FROM users WHERE id = $_SESSION['auth_id']
        $queryBuilder = DataBase::getDataBase()->createQueryBuilder();

        $user = $queryBuilder
            ->select('*')
            ->from('users')
            ->where('id = ?')
            ->setParameter(0, $_SESSION['auth_id'])
            ->fetchAssociative();

        return [
            'id' => $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $user['password'],
            'confirmedPassword' => $user['confirmedPassword']
        ];
    }
}
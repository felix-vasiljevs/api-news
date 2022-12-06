<?php

namespace App\Services;

use App\DataBase;
use Doctrine\DBAL\Connection;

class RegisterService
{
    private Connection $connection;

    public function __construct()
    {
        $this->connection = DataBase::getConnection();
    }

    public function check(string $email): bool
    {
        $fetchEmail = $this->connection->fetchAllKeyValue("SELECT id, email FROM 'news-api'.users");

        if (isset($email, $fetchEmail)) {
            return true;
        }
        return false;
    }

    public function execute(RegisterServiceRequest $request): Connection
    {
        $this->connection->insert(
            'users',
            [
                'name' => $request->getName(),
                'email' => $request->getEmail(),
                'password' => $request->getPassword(),
                'confirmedPassword' => $request->getConfirmedPassword()
            ]
        );
        return $this->connection;
    }
}
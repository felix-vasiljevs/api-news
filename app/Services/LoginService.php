<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;

class LoginService
{
    public function __construct()
    {
        $connectionParams = [
            'dbname' => 'news-api',
            'user' => 'root',
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host' => $_ENV['MYSQL_HOST'],
            'driver' => 'pdo_mysql',
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function execute(LoginServiceRequest $request)
    {
        $connecting = $this->connection->executeQuery(
            'SELECT id FROM `news-api`.users WHERE email=? AND password=?',
            [
                'email' => $request->getEmail(),
                'password' => $request->getPassword()
            ]
        );
    }
}
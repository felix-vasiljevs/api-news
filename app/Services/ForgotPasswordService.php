<?php

namespace App\Services;

use Doctrine\DBAL\DriverManager;
use Dotenv\Dotenv;

class ForgotPasswordService
{
    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::create('users');
        $dotenv->required(['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASS']);

        $connectionParams = [
            'dbname' => 'news-api',
            'user' => 'root',
            'password' => $_ENV['MYSQL_PASSWORD'],
            'host' => $_ENV['MYSQL_HOST'],
            'driver' => 'pdo_mysql',
        ];
        $this->connection = DriverManager::getConnection($connectionParams);
    }

    public function create(RegisterServiceRequest $request)
    {
        $this->connection->update(
            'users',
            [
                'email' => $request->getEmail(),
                'password' => $request->getPassword(),
            ]);
        // insert into database
    }
}
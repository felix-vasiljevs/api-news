<?php

namespace App\Services;

class ChangeEmailService
{
    public function showForm()
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

    public function change()
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
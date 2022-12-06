<?php

namespace App;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\DriverManager;

class DataBase
{
    private static ?Connection $connection = null;

    public static function getConnection(): Connection
    {
        if (self::$connection == null) {
            $connectionParams = [
                'dbname' => $_ENV['MYSQL_DBNAME'],
                'user' => $_ENV['MYSQL_USER'],
                'password' => $_ENV['MYSQL_PASSWORD'],
                'host' => $_ENV['MYSQL_HOST'],
                'driver' => $_ENV['MYSQL_DRIVER'],
            ];
            self::$connection = DriverManager::getConnection($connectionParams);
        }
        return self::$connection;
    }
}
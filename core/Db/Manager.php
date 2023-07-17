<?php

namespace Core\Db;

use Core\Parameter;
use PDO;

abstract class Manager
{
    private static PDO $pdo;

    protected static function getCnxConfig() : ?PDO
    {
        if (!isset(self::$pdo))
        {
            $host = Parameter::get('db_host');
            $name = Parameter::get('db_name');
            $user = Parameter::get('db_user');
            $password = Parameter::get('db_password');

            self::$pdo = new PDO('mysql:host='.$host.';dbname='.$name.';charset=utf8', $user, $password);
        }

        return self::$pdo;
    }
}
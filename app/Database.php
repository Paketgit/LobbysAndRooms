<?php

class Database
{
    public static function connect()
    {
        $c = require __DIR__ . '/../config/config.php';
        $dsn = "mysql:host={$c['host']};dbname={$c['database']};charset=utf8mb4";
        return new PDO($dsn, $c['user'], $c['password']);
    }
}
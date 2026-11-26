<?php

require_once __DIR__ . '/../Database.php';

class User
{
    public static function register($name, $email, $password)
    {
        $db = Database::connect();

        $q = $db->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $q->execute([$name, $email, password_hash($password, PASSWORD_DEFAULT)]);
    }

    public static function login($email, $password)
    {
        $db = Database::connect();

        $q = $db->prepare("SELECT * FROM users WHERE email = ?");
        $q->execute([$email]);

        $u = $q->fetch(PDO::FETCH_ASSOC);

        return ($u && password_verify($password, $u['password'])) ? $u : false;
    }

    public static function allExcept($id)
    {
        $db = Database::connect();

        $q = $db->prepare("SELECT id, username FROM users WHERE id <> ?");
        $q->execute([$id]);

        return $q->fetchAll(PDO::FETCH_ASSOC);
    }
}
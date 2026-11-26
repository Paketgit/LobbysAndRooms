<?php

require_once __DIR__ . '/../Models/User.php';

class AuthController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $u = User::login($_POST['email'], $_POST['password']);

            if ($u) {
                $_SESSION['user'] = $u;

                header('Location: /?page=lobbies');
                exit;
            }

            $error = 'Неверный email или пароль';
        }

        require __DIR__ . '/../Views/login.php';
    }

    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                User::register($_POST['username'], $_POST['email'], $_POST['password']);

                header('Location: /?page=login'); // ← без изменений
                exit;
            } catch (PDOException $e) {
                $error = 'Такой email уже зарегистрирован';
            }
        }

        require __DIR__ . '/../Views/register.php';
    }

    public function logout()
    {
        session_destroy();

        header('Location: /?page=login');
        exit;
    }
}
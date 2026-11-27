<?php

require_once __DIR__ . '/../Models/Lobby.php';
require_once __DIR__ . '/../Models/User.php';

class LobbyController
{
    public function index()
    {
        $lobbies = Lobby::all();
        require __DIR__ . '/../Views/lobbies.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            Lobby::create(
                $_POST['title'],
                $_POST['game'],
                $_SESSION['user']['id'],
                $_POST['max_players']
            );

            header('Location: /?page=lobbies');
            exit;
        }

        require __DIR__ . '/../Views/create.php';
    }

    public function show()
    {
        $id = (int) ($_GET['id'] ?? 0);
        $members = Lobby::members($id);
        $isMember = Lobby::isMember($id, $_SESSION['user']['id']);
        $users = User::allExcept($_SESSION['user']['id']);

        require __DIR__ . '/../Views/lobby.php';
    }

    public function join()
    {
        Lobby::join($_POST['lobby_id'], $_SESSION['user']['id']);

        header('Location: /?page=lobbies');
        exit;
    }
    
    public function leave()
    {
        Lobby::leave($_POST['lobby_id'], $_SESSION['user']['id']);
        header('Location: /?page=lobbies');
        exit;
    }
}
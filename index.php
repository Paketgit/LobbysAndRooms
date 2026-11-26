<?php
session_start();

require_once __DIR__.'/app/Controllers/AuthController.php';
require_once __DIR__.'/app/Controllers/LobbyController.php';

$page = $_GET['page'] ?? 'login';

if(!isset($_SESSION['user']) && !in_array($page, ['login','register'])) {
    header('Location: /?page=login'); 
    exit;
}

$auth = new AuthController();
$lobby = new LobbyController();

switch($page) {
    case 'login':    
        $auth->login(); 
        break;
    case 'register': 
        $auth->register(); 
        break;
    case 'logout':   
        $auth->logout(); 
        break;
    case 'lobbies':  
        $lobby->index(); 
        break;
    case 'create':   
        $lobby->create(); 
        break;
    case 'lobby':    
        $lobby->show(); 
        break;
    case 'join':     
        $lobby->join(); 
        break;
    default: 
        echo 'Страница не найдена';
}
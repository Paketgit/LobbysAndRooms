<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>GameLobby</title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
    <header>
        <b>GameLobby</b>

        <?php if(isset($_SESSION['user'])): ?>
        <nav>
            <a href="/?page=lobbies">Лобби</a>
            <a href="/?page=invitations">Приглашения</a>
            <a href="/?page=logout">Выйти</a>
        </nav>
        <?php endif; ?>
    </header>
    <main>
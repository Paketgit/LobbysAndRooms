<?php require __DIR__ . '/header.php'; ?>

<h1>Создание лобби</h1>

<form method="post">
    <label>Название</label>
    <input name="title" required>

    <label>Игра</label>
    <input name="game" required>

    <label>Максимум игроков</label>
    <select name="max_players">
        <option>2</option>
        <option selected>4</option>
        <option>5</option>
        <option>8</option>
    </select>

    <button>Создать</button>
</form>

<a href="/?page=lobbies">Назад</a>

<?php require __DIR__ . '/footer.php'; ?>
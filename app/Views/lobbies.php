<?php require __DIR__ . '/header.php'; ?>

<h1>Игровые лобби</h1>

<p><a class="button" href="/?page=create">Создать лобби</a></p>

<?php foreach ($lobbies as $item): ?>
    <div class="item">
        <h2><?= htmlspecialchars($item['title']) ?></h2>
        <p>Игра: <?= htmlspecialchars($item['game']) ?></p>
        <p>Владелец: <?= htmlspecialchars($item['username']) ?></p>
        <p>Игроков: <?= $item['player_count'] ?> / <?= $item['max_players'] ?></p>
        <a href="/?page=lobby&id=<?= $item['id'] ?>">Открыть</a>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/footer.php'; ?>
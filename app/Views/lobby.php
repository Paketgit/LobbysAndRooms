<?php require __DIR__ . '/header.php'; ?>

<h1>Участники лобби</h1>

<div class="item">
    <?php foreach ($members as $m): ?>
        <p><?= htmlspecialchars($m['username']) ?></p>
    <?php endforeach; ?>
</div>

<?php if (!$isMember): ?>
    <form method="post" action="/?page=join">
        <input type="hidden" name="lobby_id" value="<?= $id ?>">
        <button>Присоединиться</button>
    </form>
<?php endif; ?>

<a href="/?page=lobbies">Назад</a>

<?php require __DIR__ . '/footer.php'; ?>
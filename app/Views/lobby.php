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
<?php else: ?>
    <h2>Пригласить пользователя</h2>

    <form method="post" action="/?page=send">
        <input type="hidden" name="lobby_id" value="<?= $id ?>">
        <select name="receiver_id">
            <?php foreach ($users as $u): ?>
                <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['username']) ?></option>
            <?php endforeach; ?>
        </select>
        <button>Отправить приглашение</button>
    </form>
        <form method="post" action="/?page=leave" style="margin-top: 20px;">
        <input type="hidden" name="lobby_id" value="<?= $id ?>">
        <button style="background: #b00020;">Выйти из лобби</button>
    </form>
<?php endif; ?>

<a href="/?page=lobbies">Назад</a>

<?php require __DIR__ . '/footer.php'; ?>
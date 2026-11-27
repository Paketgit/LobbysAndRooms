<?php require __DIR__ . '/header.php'; ?>

<h1>Мои приглашения</h1>

<?php if (empty($invitations)): ?>
    <p>У вас пока нет приглашений.</p>
<?php endif; ?>

<?php foreach ($invitations as $i): ?>
    <div class="item">
        <h2><?= htmlspecialchars($i['title']) ?></h2>
        <p>От: <?= htmlspecialchars($i['sender']) ?></p>
        <p>Статус: <?= htmlspecialchars($i['status']) ?></p>

        <?php if ($i['status'] === 'pending'): ?>
            <form method="post" action="/?page=accept">
                <input type="hidden" name="invitation_id" value="<?= $i['id'] ?>">
                <button>Принять</button>
            </form>

            <form method="post" action="/?page=decline">
                <input type="hidden" name="invitation_id" value="<?= $i['id'] ?>">
                <button>Отклонить</button>
            </form>
        <?php endif; ?>
    </div>
<?php endforeach; ?>

<?php require __DIR__ . '/footer.php'; ?>
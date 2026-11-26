<?php require __DIR__ . '/header.php'; ?>

<h1>Регистрация</h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label>Имя</label>
    <input name="username" required>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Пароль</label>
    <input type="password" name="password" required>

    <button>Зарегистрироваться</button>
</form>

<p><a href="/?page=login">Назад ко входу</a></p>

<?php require __DIR__ . '/footer.php'; ?>
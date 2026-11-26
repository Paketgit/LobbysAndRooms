<?php require __DIR__ . '/header.php'; ?>

<h1>Вход</h1>

<?php if (!empty($error)): ?>
    <p class="error"><?= htmlspecialchars($error) ?></p>
<?php endif; ?>

<form method="post">
    <label>Email</label>
    <input type="email" name="email" required>

    <label>Пароль</label>
    <input type="password" name="password" required>

    <button>Войти</button>
</form>

<p>Нет аккаунта? <a href="/?page=register">Регистрация</a></p>

<?php require __DIR__ . '/footer.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>POS Login</title>
</head>
<body>
    <h1>POS Login</h1>

    <?php if ($error = session()->getFlashdata('error')): ?>
        <p role="alert"><?= esc($error) ?></p>
    <?php endif; ?>

    <form action="<?= esc(site_url('login'), 'attr') ?>" method="post">
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input id="username" name="username" autocomplete="username" required>

        <label for="password">Password</label>
        <input id="password" name="password" type="password"
               autocomplete="current-password" required>

        <button type="submit">Log in</button>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>User Accounts</title>
</head>
<body>

    <!--logout section-->
<form action="<?= esc(site_url('logout'), 'attr') ?>" method="post">
    <?= csrf_field() ?>
    <button type="submit">Log out</button>
</form>


    <nav>
        <a href="<?= site_url('/') ?>">Home</a> |
        <a href="<?= site_url('about') ?>">About</a> |
        <a href="<?= site_url('customers') ?>">Customers</a> |
        <a href="<?= site_url('users') ?>">Users</a>
    </nav>


    <h1>User Accounts</h1>
    <p><a href="<?= site_url('users/new') ?>">Add User</a></p>

    <table border="1">
        <tr>
            <th>Avatar</th>
            <th>Username</th>
            <th>Full Name</th>
            <th>Created At</th>
            <th>Action</th>
        </tr>

        <?php if ($users === []): ?>
            <tr><td colspan="5">No user records found.</td></tr>
        <?php else: ?>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td>
                        <?php if (! empty($user['avatar'])): ?>
                            <img
                                src="<?= esc(base_url('uploads/avatars/' . rawurlencode($user['avatar'])), 'attr') ?>"
                                alt="<?= esc($user['full_name'], 'attr') ?> profile picture"
                                width="48" height="48"
                                style="object-fit: cover;">
                        <?php else: ?>
                                 <img src="<?= esc(base_url('images/avatar-placeholder.svg'), 'attr') ?>"
         alt="Default               profile picture" width="48" height="48">
                        <?php endif; ?>
                    </td>
                    <td><?= esc($user['username']) ?></td>
                    <td><?= esc($user['full_name']) ?></td>
                    <td><?= esc($user['created_at']) ?></td>
                    <td>
                        <a href="<?= site_url('users/' . $user['id'] . '/edit') ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>
</body>
</html>
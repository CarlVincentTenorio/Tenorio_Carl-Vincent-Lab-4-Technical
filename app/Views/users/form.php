<?php $isEdit = $user !== null; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title><?= $isEdit ? 'Edit User' : 'Add User' ?></title>
</head>

<body>
    <h1><?= $isEdit ? 'Edit User' : 'Add User' ?></h1>

    <?php if ($error = session()->getFlashdata('upload_error')): ?>
        <p role="alert"><?= esc($error) ?></p>
    <?php endif; ?>

    <form action="<?= site_url($isEdit ? 'users/' . $user['id'] : 'users') ?>" method="post" <?= $isEdit ? 'enctype="multipart/form-data"' : '' ?> novalidate>
        <?= csrf_field() ?>

        <label for="username">Username</label>
        <input id="username" name="username" value="<?= set_value('username', $user['username'] ?? '') ?>">
        <?= validation_show_error('username') ?>

        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name" value="<?= set_value('full_name', $user['full_name'] ?? '') ?>">
        <?= validation_show_error('full_name') ?>

        <label for="password">
            <?= $isEdit ? 'New password (leave blank to keep current)' : 'Password' ?>
        </label>
        <input id="password" name="password" type="password" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
        <?= validation_show_error('password') ?>

        <label for="confirm_password">Confirm password</label>
        <input id="confirm_password" name="confirm_password" type="password" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
        <?= validation_show_error('confirm_password') ?>

        <?php if ($isEdit): ?>
            <label for="avatar">Profile picture (optional; JPG or PNG, up to 2 MB)</label>
            <input id="avatar" name="avatar" type="file" accept=".jpg,.jpeg,.png,image/jpeg,image/png">
            <?= validation_show_error('avatar') ?>
            <p>Leave this blank to keep the current picture.</p>
        <?php endif; ?>

        <button type="submit"><?= $isEdit ? 'Update User' : 'Add User' ?></button>
    </form>

    <p><a href="<?= site_url('users') ?>">Back to users</a></p>
</body>

</html>
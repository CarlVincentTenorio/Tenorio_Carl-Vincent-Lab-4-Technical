<?php $isEdit = $customer !== null; ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= $isEdit ? 'Edit Customer' : 'Add Customer' ?></title>
</head>
<body>
    <h1><?= $isEdit ? 'Edit Customer' : 'Add Customer' ?></h1>

    <form action="<?= site_url($isEdit ? 'customers/' . $customer['id'] : 'customers') ?>"
          method="post" novalidate>
        <?= csrf_field() ?>

        <label for="full_name">Full name</label>
        <input id="full_name" name="full_name"
               value="<?= set_value('full_name', $customer['full_name'] ?? '') ?>">
        <?= validation_show_error('full_name') ?>

        <label for="email">Email</label>
        <input id="email" name="email" type="email"
               value="<?= set_value('email', $customer['email'] ?? '') ?>">
        <?= validation_show_error('email') ?>

        <label for="phone">Phone (optional)</label>
        <input id="phone" name="phone" type="tel"
               value="<?= set_value('phone', $customer['phone'] ?? '') ?>">
        <?= validation_show_error('phone') ?>

        <button type="submit"><?= $isEdit ? 'Update Customer' : 'Add Customer' ?></button>
    </form>

    <p><a href="<?= site_url('customers') ?>">Back to customers</a></p>
</body>
</html>
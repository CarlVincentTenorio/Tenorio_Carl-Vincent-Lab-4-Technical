<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Customer Accounts</title>
</head>
<body>

<nav>
    <a href="<?= site_url('/') ?>">Home</a> |
    <a href="<?= site_url('about') ?>">About</a> |
    <a href="<?= site_url('customers') ?>">Customers</a> |
    <a href="<?= site_url('users') ?>">Users</a>
</nav>

<h1>Customer Accounts</h1>

<p><a href="<?= site_url('customers/new') ?>">Add Customer</a></p>

<table border="1">
    <tr>
        <th>Full Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Actions</th>
    </tr>

    <?php if ($customers === []): ?>
        <tr>
            <td colspan="4">No customer records found.</td>
        </tr>
    <?php else: ?>
        <?php foreach ($customers as $customer): ?>
            <tr>
                <td><?= esc($customer['full_name']) ?></td>
                <td><?= esc($customer['email']) ?></td>
                <td><?= esc($customer['phone'] ?? '') ?></td>
                <td>
                    <a href="<?= site_url('customers/' . $customer['id'] . '/edit') ?>">
                        Edit
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php endif; ?>
</table>

</body>
</html>
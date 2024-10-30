<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Styles here */
    </style>
    <title>User List</title>
</head>
<body>
<?php
require_once _DIR_ . '/partials/header.php';

echo "Attempting to retrieve registered users...<br>";
$registered = User::allRegistered();

if (empty($registered)) {
    echo "No registered users found or error retrieving data.";
} else {
    echo "<pre>";
    print_r($registered);
    echo "</pre>";
}
?>
    <table>
        <thead>
            <tr>
                <th class="email-col">Email</th>
                <th>Status</th>
                <th class="date-col">Date of Registration</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($registered)): ?>
                <?php foreach ($registered as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td><?= htmlspecialchars($user['status']) ?></td>
                        <td><?= htmlspecialchars($user['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
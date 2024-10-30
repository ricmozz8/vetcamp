<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php';
?>
<body>
<?php
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
                        <td><?= htmlspecialchars($user->values['email']) ?></td>
                        <td><?= htmlspecialchars($user->values['status']) ?></td>
                        <td><?= htmlspecialchars($user->values['created_at']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
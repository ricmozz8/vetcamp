<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <div class="padded-min">
        <h1>There was an error (<?= $code ?>)</h1>
        <p><?= $message ?></p>

        <br><br>
        <a href="/">Go back</a>
    </div>
</body>

</html>
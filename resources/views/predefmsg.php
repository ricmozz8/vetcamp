<!DOCTYPE html>
<html lang="en">
    <?php
    require_once __DIR__ . '/partials/header.php';


    // Categories translations array
    $categoryES = [
        'all' => 'Todos',
        'approved' => 'Aprobados',
        'denied' => 'Denegados'
    ];

    ?>
    <body>

    <?php
        if (session_has('success')) {
            echo '<p class="success">' . session_get('success') . '</p>';
        }
    ?>
    <form action="/admin/predef/update" method="POST">
        
        <?php foreach ($messages as $message) { ?>
            <label for="<?= $message->category; ?>">
                <?=$categoryES[$message->category]?>
            </label>
            <input type="hidden" name="message_id" value="<?=$message->id?>">
            <textarea name="<?= $message->category; ?>"><?=$message->content?></textarea>
            <br>
        <?php } ?>

        <button class="main-action-bright secondary">Guardar</button>
    </form>

    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>
<body>
<style>
    .all-centered {
        max-width: 600px;
        margin: auto;
        text-align: center;
        padding: 19dvh 0;
        user-select: none;

    }

    .fatal-icon {
        width: 100px;
    }

    .all-centered h3 {
        font-size: 5em;
        font-weight: bold;
        margin: 0;
    }

    .all-centered h4 {
        font-size: 2em;
    }

    .all-centered p {
        font-size: 1em;
        margin: 1em 0;
    }

    .small-reason {
        width: 20px;
    }

    .centerme{
        margin-top: 15dvh;
        justify-content: center;
        text-align: left;
        text-wrap: nowrap;

    }

    .centerme p{
        font-family: monospace !important;
        user-select: all !important;

    }

</style>
<!--- Define your structure here --->

<div class="all-centered">
    <img draggable="false" class="fatal-icon" src="/<?= asset('/logo/svg/fatal-icon.svg') ?>" alt="Vetcamp fatal error">

    <h3>¡Oh no!</h3>
    <h4>Nos hemos encontrado con un problema</h4>

    <p>No te preocupes, esto no ha sido tu culpa. Nos encontramos trabajando en el asunto y lo resolveremos en breve.</p>

    <div class="flex-min centerme">
        <img class="small-reason" src="/<?= asset('/logo/svg/code-nd00.svg') ?>" alt="">
        <strong>Datos técnicos:</strong>
        <?php if($reason === 'disk') { ?>
        <p>Could not ensure byte allocation on current server disk, please free or move the current location.
        </p>
        <?php } ?>
    </div>
</div>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php';
?>
<!-- $code -->


<body class="server-error-body">
    <div class="error-container">
        <div class="iso-centered">
            <img src="<?= asset('logo/SVG/vetcamp_iso_w.svg') ?>" alt="">
            <h2>Ha ocurrido un error!</h2>
            <?php if ($code == 404) { ?>
                <p>La página solicitada no existe.</p>
            <?php } else { ?>
                <p>Ha ocurrido un error inesperado.</p>
            <?php } ?>
        </div>
        <div class="error-content">
            
            
            <a href="<?php echo $_SERVER['HTTP_REFERER'] ?? '/'; ?>" class="main-action-bright negative">Volver atrás</a>

            <p class="error-subtitle">Si crees que esta página debería estar disponible, contacta con el administrador.</p>
            
        </div>
    </div>
</body>

</html>

</html>
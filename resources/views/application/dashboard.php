<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <h1 class="left-margin title">Mis solicitudes</h1>


    <div class="application-card">

        <div class="splitted-title-head">
            <h3>Vetcamp Verano <?php echo date('Y'); ?></h3>
            <p class="status not-filled">Estado: <?php echo 'Sin llenar'; ?></p>
        </div>

        <p>Campamento de verano para estudiantes de escuela
            superior interesados en la tecnología veterinaria.
            Se llevará a cabo bajo 4 sesiones
        </p>

        <div class="status-actions">
            <form action="/apply/application" method="POST">
            <input type="hidden" name="stage" value="1">
            <button class="main-action-bright" type="submit">Llenar solicitud</button>
            </form>
        </div>



    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
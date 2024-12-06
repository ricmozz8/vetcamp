<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
$application = Auth::user()->application();
$status = $application ? $application->status : 'Sin llenar';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <h1 class="left-margin title">Mis solicitudes</h1>


    <div class="application-card">

        <div class="splitted-title-head">
            <h3>Vetcamp Verano <?php echo date('Y'); ?></h3>
            <div class="flex-min">
                <p>Estado: </p>
                <p class="status <?= str_replace(' ', '-', strtolower($status)) ?>"><?php echo $status; ?></p>
            </div>

        </div>

        <p>Campamento de verano para estudiantes de escuela
            superior interesados en la tecnología veterinaria.
            Se llevará a cabo bajo 4 sesiones de 14 estudiantes.
        </p>
        <p><strong>Profesora:</strong> Rebeka Sanabria</p>

        <div class="status-actions">
            <a href="/apply/application" class="main-action-bright secondary" type="submit">
                <?php echo $status == 'Sin llenar' ? 'Llenar Solicitud' : 'Editar Solicitud'; ?>
            </a>
        </div>



    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
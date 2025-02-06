<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
$application = Auth::user()->application();
$status = 'Sin llenar';

/*
  Este comentario se tiene que borrar
  Antes de borrarlo verificar el codigo de la linea 19 a 34.

if ($application && $application->isSubmitted()) {
    $status = $application->status === 'Necesita Cambios' ? 'Necesita Cambios' : 'Sometida';
} else if ($application) {
    $status = $application->status;
}
*/

if ($application && $application->isSubmitted()) {
    if ($application->status === 'Sometida') {
        $status = 'Sometida';
    } else if ($application->status === 'Necesita Cambios') {
        $status = 'Necesita Cambios';
    } else if ($application->status === 'Rechazado') {
        $status = 'Rechazado';
    } else if ($application->status === 'Aceptado') {
        $status = 'Aceptado';
    }
    else {
        $status = $application->status;
    }
} else if ($application) {
    $status = $application->status;
}

?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>

    <div class="application-card">

        <div class="application-deco-banner">
            <img draggable="false" aria-selected="false" src="<?php echo asset('img/solic_img.png') ?>" alt="">
        </div>
        <div class="application-card-action">
            <div class="application-card-head">
                <div onclick="openModal('applicationStatusHelp')" class="status-info">
                    <p>Estado: </p>
                    <p class="status <?= str_replace(' ', '-', strtolower($status)) ?>"><?php echo $status; ?></p>
                </div>

                <h3>Vetcamp Verano <?php echo date('Y'); ?></h3>


            </div>

            <p class="application-card-copy">Campamento de verano para estudiantes de escuela
                superior interesados en la tecnología veterinaria.
                Se llevará a cabo bajo 4 sesiones de 14 estudiantes.
            </p>

            <div class="status-actions-centered">
                <a  href="/apply/application" class="main-action-bright tertiary <?php echo !$can_apply ? 'disabled' : ''; ?> " type="submit">
                    <?php echo $can_apply ? ($status == 'Sin llenar' ? 'Llenar Solicitud' : 'Editar Solicitud') : 'Las solicitudes están cerradas temporalmente'; ?>
                </a>
            </div>
        </div>



    </div>

    <?php require_once(__DIR__ . '../../modals/applicationStatusHelp.php'); ?>
    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
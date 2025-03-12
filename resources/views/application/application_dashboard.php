<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
$application = Auth::user()->application();
$status = 'Sin llenar';


if ($application && $application->isSubmitted()) {
    $status = $application->status === 'Necesita Cambios' ? 'Necesita Cambios' : 'Sometida';
} else if ($application) {
    $status = $application->status;
}

?>

<body>
<?php require_once(__DIR__ . '../../partials/profileNav.php'); ?>

<div class="application-card">

    <div class="application-card-action">

        <div class="application-card-head">
            <div class="application-title">
                <img class="no-mobile companion-icon" src="/<?= asset('logo/SVG/vetcamp-icon-black.svg') ?>" alt="">
                <h2> Solicitud Vetcamp <?php echo date('Y'); ?></h2>
            </div>

            <div class="application-actions">
                <a href="/apply/application"
                   class="main-action-bright <?php echo !$can_apply ? 'disabled-alt' : ''; ?> " type="submit">
                    <?php if ($can_apply) { ?>
                        <i class="fas fa-pencil"></i>
                    <?php } ?>
                    <?php echo $can_apply ? ($status == 'Sin llenar' ? 'Llenar Solicitud' : 'Editar Solicitud') : 'Ha cerrado el proceso de solicitud'; ?>
                </a>
                <div
                     class="status-info <?= str_replace(' ', '-', strtolower($status)) ?>">
                    <p class="status"><?php echo $status; ?></p>
                </div>
            </div>
        </div>

        <p class="application-card-copy">Campamento de verano para estudiantes de escuela
            superior interesados en la tecnología veterinaria.
            Se llevará a cabo bajo 4 sesiones de 14 estudiantes.
        </p>


    </div>


</div>

<?php require_once(__DIR__ . '../../modals/applicationStatusHelp.php'); ?>
<?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
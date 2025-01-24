<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
$application = Auth::user()->application();
$status = $application ? $application->status : 'Sin llenar';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>

    <div class="application-card">

        <div class="application-deco-banner">
            <img draggable="false" aria-selected="false" src="<?php echo asset('img/solic_img.png') ?>" alt="">
        </div>
        <div class="application-card-action">
            <div class="application-card-head">
                <div onclick="openModal('applicationStatusHelp')"  class="status-info">
                    <p>Estado: </p>
                    <p class="status <?= str_replace(' ', '-', strtolower($status)) ?>"><?php echo $status; ?></p>
                </div>

                <h3>Vetcamp Verano <?php echo date('Y'); ?></h3>


            </div>

            <p>Campamento de verano para estudiantes de escuela
                superior interesados en la tecnología veterinaria.
                Se llevará a cabo bajo 4 sesiones de 14 estudiantes.
            </p>
            

            <div class="status-actions">
                <a href="/apply/application" class="main-action-bright" type="submit">
                    <?php echo $status == 'Sin llenar' ? 'Llenar Solicitud' : 'Editar Solicitud'; ?>
                </a>
            </div>
        </div>



    </div>  

    <?php require_once(__DIR__ . '../../modals/applicationStatusHelp.php'); ?>
    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
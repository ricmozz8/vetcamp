<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="section-head">
        <h1 >Vetcamp Verano <?php echo date('Y'); ?></h1>
        <form action="" method="POST">
            <input type="hidden" name="stage" value="3">
            <button class="main-action-bright"><i class="las la-arrow-left"></i></button>
        </form>
    </div>



    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress four"></div>
        </div>

        <div class="tabs">
            <span class="tab">Datos básicos</span>
            <span class="tab ">Contacto</span>
            <span class="tab ">Documentos</span>
            <span class="tab active">Confirmar</span>
        </div>


        <form action="" method="POST">
            <!-- Document upload section -->
         
            <div class="form-actions">
                <input type="hidden" name="stage" value="">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button class="main-action-bright  secondary">Confirmar</button>
            </div>
        </form>
    </div>




    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="section-head">
        <h1 class="">Vetcamp Verano <?php echo date('Y'); ?></h1>
        <form action="" method="POST">
            <input type="hidden" name="stage" value="2">
            <button class="main-action-bright"><i class="las la-arrow-left"></i></button>
        </form>
    </div>



    <div class="application-form-card">

        <div class="progress-bar">
            <div class="progress three"></div>
        </div>

        <div class="tabs">
            <span class="tab">Datos básicos</span>
            <span class="tab ">Contacto</span>
            <span class="tab active">Documentos</span>
            <span class="tab">Confirmar</span>
        </div>


        <!-- Document upload section -->
        <form action="" method="POST">
            <div class="document-section">
                <!-- Document upload boxes -->
                <div class="document-group">
                    <div class="upload-box">
                        <label for="solicitud_escrita"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="solicitud_escrita" name="solicitud_escrita">
                    </div>
                    <div class="flex">
                        <label>Solicitud Escrita</label>
                        <button class="btn-download">Descargar</button>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="credito"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="credito" name="credito">
                    </div>
                    <label>Transcripción de crédito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="escrito"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="escrito" name="escrito">
                    </div>
                    <label>Ensayo escrito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="foto"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="foto" name="foto">
                    </div>
                    <label>Foto 2x2</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="ensayo_video"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="ensayo_video" name="ensayo_video">
                    </div>
                    <label>Ensayo en video</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">


                        <label for="carta_autorizacion"><i class="las la-file"></i> Seleccionar archivo</label>
                        <input type="file" id="carta_autorizacion" name="carta_autorizacion">
                    </div>
                    <label>Carta de Autorización</label>
                </div>
            </div>
            <div class="form-actions">
                <input type="hidden" name="stage" value="4">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button class="main-action-bright  secondary">Siguiente</button>
            </div>
        </form>
    </div>




    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
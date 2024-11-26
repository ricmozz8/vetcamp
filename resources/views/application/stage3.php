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
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="document-section">
                <!-- Document upload boxes -->
                <div class="document-group">
                    <div class="upload-box">
                        <label for="solicitud_escrita"> <span> Selecciona un archivo</span></label>
                        <input accept="application/pdf" type="file" id="solicitud_escrita" name="solicitud_escrita" onchange="updateFileName(this)">
                    </div>
                    <div class="check-labeled">
                        <label>Solicitud Escrita</label>
                        <button class="btn-download">Descargar</button>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="credito"> <span> Selecciona un archivo</span></label>
                        <input accept="application/pdf" type="file" id="credito" name="credito" onchange="updateFileName(this)">
                    </div>
                    <label>Transcripción de crédito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="escrito"><span> Selecciona un archivo</span></label>
                        <input accept="application/pdf" type="file" id="escrito" name="escrito" onchange="updateFileName(this)">
                    </div>
                    <label>Ensayo escrito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="foto"> <span> Selecciona un archivo</span></label>
                        <input accept="image/*" type="file" id="foto" name="foto" onchange="updateFileName(this)">
                    </div>
                    <label>Foto 2x2</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="ensayo_video"> <span> Selecciona un archivo</span></label>
                        <input accept="video/*" type="file" id="ensayo_video" name="ensayo_video" onchange="updateFileName(this)">
                    </div>
                    <label>Ensayo en video</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">


                        <label for="carta_autorizacion"><span> Selecciona un archivo</span> </label>
                        <input accept="application/pdf" type="file" id="carta_autorizacion" name="carta_autorizacion" onchange="updateFileName(this)">
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
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="section-head">
        <h1 class="">Vetcamp Verano <?php echo date('Y'); ?></h1>
        <a href="/apply/application/contact" class="main-action-bright"><i class="las la-arrow-left"></i>Atrás</a>
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
                        <label for="written_application"> <span> Selecciona un archivo</span></label>
                        <input  accept="application/pdf" type="file" id="written_application" name="written_application" onchange="updateFileName(this)">
                    </div>
                    <div class="check-labeled">
                        <label>Solicitud Escrita</label>
                          <a href="/solicitud" class="btn-download">Descargar </a>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="transcript"> <span> Selecciona un archivo</span></label>
                        <input  accept="application/pdf" type="file" id="transcript" name="transcript" onchange="updateFileName(this)">
                    </div>
                    <label>Transcripción de crédito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <label for="written_essay"><span> Selecciona un archivo</span></label>
                        <input  accept="application/pdf" type="file" id="written_essay" name="written_essay" onchange="updateFileName(this)">
                    </div>
                    <label>Ensayo escrito</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="picture"> <span> Selecciona un archivo</span></label>
                        <input  accept="image/*" type="file" id="picture" name="picture" onchange="updateFileName(this)">
                    </div>
                    <label>Foto 2x2</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <label for="video_essay"> <span> Selecciona un archivo</span></label>
                        <input  accept="video/*" type="file" id="video_essay" name="video_essay" onchange="updateFileName(this)">
                    </div>
                    <label>Ensayo en video</label>
                </div>

                <div class="document-group">
                    <div class="upload-box">


                        <label for="authorization"><span> Selecciona un archivo</span> </label>
                        <input  accept="application/pdf" type="file" id="authorization" name="authorization" onchange="updateFileName(this)">
                    </div>
                    <label>Carta de Autorización</label>
                </div>
            </div>
            <div class="form-actions">
                <input type="hidden" name="stage" value="4">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button id="next-button" class="main-action-bright  secondary">Siguiente</button>
            </div>
        </form>
    </div>




    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
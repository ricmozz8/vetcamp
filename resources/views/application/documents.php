<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
<?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


<div class="application_header">
    <h1 class="">Solicitud</h1>
    <a href="/apply/application/contact" class="main-action-bright secondary"><i class="las la-arrow-left"></i>Atrás</a>
</div>

<p class="subtext" style="margin: 1em var(--main-margin); text-align: left;">
    Nota: si la plataforma no le permite subir documentos, intente reducir su tamaño comprimiéndolos y luego subirlos.
    <b style="font-weight: bold">Suba el archivo .mp4 NO suba archivos .zip, .7z, .rar ni parecidos</b> estos formatos
    no son permitidos.</p>

<p class="warning-box" style="margin: 1em var(--main-margin); text-align: left;">
    Los documentos deben pesar <b style="font-weight: 800;"> menos de 10 MB</b> de lo contrario, la plataforma no
    subirá los archivos.

</p>


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

            <!-- Written Application -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['written_application'])) { ?>

                        <?php $written_application = $saved_documents['written_application']; ?>
                        <label formats="pdf" for="written_application"> <span> <i class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $written_application['name'] ?>" type="file"
                               id="written_application" name="written_application" onchange="updateFileName(this)">


                    <?php } else { ?>

                        <label formats="pdf" for="written_application"> <i class="las la-file-upload"></i> <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="written_application" name="written_application"
                               onchange="updateFileName(this)">

                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Certificación Estudiantil (PDF)</label>
                    <a href="/solicitud" target="_blank" class="btn-download">Descargar </a>
                    <?php if (isset($saved_documents['written_application'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $written_application['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>

            </div>

            <!-- Transcript upload -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['transcript'])) { ?>
                        <?php $transcript = $saved_documents['transcript']; ?>
                        <label formats="pdf" for="transcript"> <span> <i class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $transcript['name'] ?>" type="file" id="transcript"
                               name="transcript" onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label formats="pdf" for="transcript"><i class="las la-file-upload"></i>
                            <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="transcript" name="transcript"
                               onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Transcripción de crédito (PDF)</label>
                    <?php if (isset($saved_documents['transcript'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $transcript['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>

            </div>

            <!-- Written Essay -->

            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['written_essay'])) { ?>
                        <?php $written_essay = $saved_documents['written_essay']; ?>
                        <label formats="pdf" for="written_essay"> <span> <i
                                        class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $written_essay['name'] ?>" type="file"
                               id="written_essay" name="written_essay" onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label formats="pdf" for="written_essay"><i class="las la-file-upload"></i>
                            <span> Subir archivo</span></label>
                        <input accept="application/pdf" type="file" id="written_essay" name="written_essay"
                               onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Ensayo escrito (PDF)</label>
                    <?php if (isset($saved_documents['written_essay'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $written_essay['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>


            </div>

            <!-- Picture upload -->

            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['picture'])) { ?>
                        <?php $picture = $saved_documents['picture']; ?>
                        <label formats="png,jpeg,jpg" for="picture"> <span> <i
                                        class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="image/*" value=" <?= $picture['name'] ?>" type="file" id="picture" name="picture"
                               onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label formats="png,jpeg,jpg" for="picture"> <i class="las la-file-upload"></i> <span> Subir archivo</span></label>
                        <input accept="image/*" type="file" id="picture" name="picture" onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Foto 2x2 (PNG, JPEG, JPG)</label>
                    <?php if (isset($saved_documents['picture'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $picture['name'] ?>')" class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>

            </div>

            <!-- Video Essay -->

            <div class="document-group">
                <div class="upload-box">

                    <?php if (isset($saved_documents['video_essay'])) { ?>
                        <?php $video_essay = $saved_documents['video_essay']; ?>
                        <label formats="mp4" for="video_essay"><span> <i class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="video/*" value=" <?= $video_essay['name'] ?>" type="file" id="video_essay"
                               name="video_essay" onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label formats="mp4" for="video_essay"> <i class="las la-file-upload"></i>
                            <span> Subir archivo</span></label>
                        <input accept="video/*" type="file" id="video_essay" name="video_essay"
                               onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Ensayo en video (MP4)</label>
                    <?php if (isset($saved_documents['video_essay'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $video_essay['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>

            </div>

            <!-- Authorization Letter -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['authorization_letter'])) { ?>
                        <?php $authorization = $saved_documents['authorization_letter']; ?>
                        <label formats="pdf" for="authorization_letter"> <span> <i class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $authorization['name'] ?>" type="file"
                               id="authorization_letter" name="authorization_letter" onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label formats="pdf" for="authorization_letter"><i class="las la-file-upload"></i> <span> Subir archivo</span>
                        </label>
                        <input accept="application/pdf" type="file" id="authorization_letter"
                               name="authorization_letter" onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Carta de Autorización (PDF)</label>
                    <?php if (isset($saved_documents['authorization_letter'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $authorization['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>
            </div>

            <!-- Recommendation Letter -->
            <div class="document-group">
                <div class="upload-box">
                    <?php if (isset($saved_documents['recommendation_letter'])) { ?>
                        <?php $recommendation = $saved_documents['recommendation_letter']; ?>
                        <label for="recommendation_letter" formats="pdf"> <span> <i class="las la-edit"></i> Editar archivo</span></label>
                        <input accept="application/pdf" value=" <?= $recommendation['name'] ?>" type="file"
                               id="recommendation_letter" name="recommendation_letter" onchange="updateFileName(this)">
                    <?php } else { ?>
                        <label for="recommendation_letter" formats="pdf"> <i class="las la-file-upload"></i> <span> Subir archivo</span>
                        </label>
                        <input accept="application/pdf" type="file" id="recommendation_letter"
                               name="recommendation_letter" onchange="updateFileName(this)">
                    <?php } ?>
                </div>
                <div class="check-labeled">
                    <label>Carta de Recomendación (PDF)</label>
                    <?php if (isset($saved_documents['recommendation_letter'])) { ?>
                        <a href="#" onclick="showModal('fileViewPopup-<?= $recommendation['name'] ?>')"
                           class="btn-download">
                            <i class="las la-eye"></i> Visualizar
                        </a>
                    <?php } ?>
                </div>
            </div>

        </div>
        <div class="form-actions">
            <input type="hidden" name="stage" value="4">
            <p>Se guardará la información una vez pulses siguiente.</p>
            <button type="submit" id="next-button" class="main-action-bright gradiented">Siguiente</button>
        </div>
    </form>
</div>

<!-- including here file view popup -->
<?php foreach ($saved_documents as $file) { ?>
    <?php require(__DIR__ . '../../modals/fileViewPopup.php'); ?>
<?php } ?>



<?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
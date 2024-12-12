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
                        <?php if (isset($saved_documents['written_application'])) { ?>

                            <?php $written_application = $saved_documents['written_application']; ?>
                            <label for="written_application"> <span> <?= $written_application['name'] ?></span></label>
                            <input accept="application/pdf" value=" <?= $written_application['name'] ?>" type="file" id="written_application file-input" name="written_application" onchange="updateFileName(this)">


                        <?php } else { ?>

                            <label for="written_application"> <span> Selecciona un archivo</span></label>
                            <input accept="application/pdf" type="file" id="written_application file-input" name="written_application" onchange="updateFileName(this)">

                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                        <label>Solicitud Escrita</label>
                        <a href="/solicitud" target="_blank" class="btn-download">Descargar </a>
                        <?php if (isset($saved_documents['written_application'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $written_application['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <?php if (isset($saved_documents['transcript'])) { ?>
                            <?php $transcript = $saved_documents['transcript']; ?>
                            <label for="transcript"> <span> <?= $transcript['name'] ?></span></label>
                            <input accept="application/pdf" value=" <?= $transcript['name'] ?>" type="file" id="transcript file-input" name="transcript" onchange="updateFileName(this)">
                        <?php } else { ?>
                            <label for="transcript"> <span> Selecciona un archivo</span></label>
                            <input accept="application/pdf" type="file" id="transcript file-input" name="transcript" onchange="updateFileName(this)">
                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                        <label>Transcripción de crédito</label>
                        <?php if (isset($saved_documents['transcript'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $transcript['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <?php if (isset($saved_documents['written_essay'])) { ?>
                            <?php $written_essay = $saved_documents['written_essay']; ?>
                            <label for="transcript"> <span> <?= $written_essay['name'] ?></span></label>
                            <input accept="application/pdf" value=" <?= $written_essay['name'] ?>" type="file" id="transcript file-input" name="transcript" onchange="updateFileName(this)">
                        <?php } else { ?>
                            <label for="written_essay"><span> Selecciona un archivo</span></label>
                            <input accept="application/pdf" type="file" id="written_essay file-input" name="written_essay" onchange="updateFileName(this)">
                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                        <label>Ensayo escrito</label>
                        <?php if (isset($saved_documents['written_essay'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $written_essay['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>


                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <?php if (isset($saved_documents['picture'])) { ?>
                            <?php $picture = $saved_documents['picture']; ?>
                            <label for="picture"> <span> <?= $picture['name'] ?></span></label>
                            <input accept="image/*" value=" <?= $picture['name'] ?>" type="file" id="picture file-input" name="picture" onchange="updateFileName(this)">
                        <?php } else { ?>
                            <label for="picture"> <span> Selecciona un archivo</span></label>
                            <input accept="image/*" type="file" id="picture file-input" name="picture" onchange="updateFileName(this)">
                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                        <label>Foto 2x2</label>
                        <?php if (isset($saved_documents['picture'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $picture['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">

                        <?php if (isset($saved_documents['video_essay'])) { ?>
                            <?php $video_essay = $saved_documents['video_essay']; ?>
                            <label for="video_essay"> <span> <?= $video_essay['name'] ?></span></label>
                            <input accept="video/*" value=" <?= $video_essay['name'] ?>" type="file" id="video_essay file-input" name="video_essay" onchange="updateFileName(this)">
                        <?php } else { ?>
                            <label for="video_essay"> <span> Selecciona un archivo</span></label>
                            <input accept="video/*" type="file" id="video_essay file-input" name="video_essay" onchange="updateFileName(this)">
                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                        <label>Ensayo en video</label>
                        <?php if (isset($saved_documents['video_essay'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $video_essay['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>

                </div>

                <div class="document-group">
                    <div class="upload-box">
                        <?php if (isset($saved_documents['authorization'])) { ?>
                            <?php $authorization = $saved_documents['authorization']; ?>
                            <label for="authorization"> <span> <?= $authorization['name'] ?></span></label>
                            <input accept="application/pdf" value=" <?= $authorization['name'] ?>" type="file" id="authorization file-input" name="authorization" onchange="updateFileName(this)">
                        <?php } else { ?>
                            <label for="authorization"><span> Selecciona un archivo</span> </label>
                            <input accept="application/pdf" type="file" id="file-input authorization" name="authorization" onchange="updateFileName(this)">
                        <?php } ?>
                    </div>
                    <div class="check-labeled">
                      <label>Carta de Autorización</label>  
                      <?php if (isset($saved_documents['authorization'])) { ?>
                            <a href="#" onclick="showModal('fileViewPopup-<?= $authorization['name'] ?>')" class="btn-download">
                                <i class="las la-eye"></i> Visualizar
                            </a>
                        <?php } ?>
                    </div>
                    
                </div>
            </div>
            <div class="form-actions">
                <input type="hidden" name="stage" value="4">
                <p>Se guardará la información una vez pulses 'siguiente'.</p>
                <button id="next-button" class="main-action-bright  secondary">Siguiente</button>
            </div>
        </form>
    </div>

    <!-- including here file view popup -->
    <?php foreach ($saved_documents as $file) { ?>
        <?php require(__DIR__ . '../../modals/fileViewPopup.php'); ?>
    <?php } ?>



    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
<?php require_once(__DIR__ . '../../partials/profileNav.php'); ?>


<div class="application_header">
    <h1>Solicitud</h1>
    <a href="/apply/application/documents" class="main-action-bright secondary"><i
                class="fas fa-arrow-left"></i>Atrás</a>
</div>


<div class="application-form-card">

    <div class="progress-bar">
        <div class="progress four"></div>
    </div>

    <div class="tabs">
        <a href="/apply/application/basic_info" class="tab">Datos básicos</a>
        <a href="/apply/application/contact" class="tab">Contacto</a>
        <a href="/apply/application/documents" class="tab">Documentos</a>
        <a href="/apply/application/confirm" class="tab active">Confirmar</a>
    </div>


    <form action="" method="POST">
        <!-- Confirmation info -->

        <div class="desk-grid">

            <div class="grid-group">
                <h3 class="valid-title"> <i class="fas fa-phone"></i> Contacto</h3>
                <div class="form-group">
                    <label for="first_name">Nombre</label>
                    <p><?= Auth::user()->first_name ?? '' ?></p>
                </div>
                <div class="form-group">
                    <label for="last_name">Apellido</label>
                    <p><?= Auth::user()->last_name ?? '' ?></p>
                </div>
                <div class="form-group">
                    <label for="email">Correo</label>
                    <p><?= Auth::user()->email ?? '' ?></p>
                </div>
                <div class="form-group">
                    <label for="phone">Teléfono</label>
                    <p><?= format_phone(Auth::user()->phone_number) ?? '' ?></p>
                </div>
            </div>


            <div class="grid-group">
                <h3 class="valid-title"><i class="fas fa-home"></i> Direcciones</h3>
                <div class="form-group">
                    <label for="postal">Dirección de la escuela</label>
                    <?php
                    if (Auth::user()->school_address()) {
                        $fullSchool = Auth::user()->school_address()->build();
                    }
                    ?>
                    <p><?= $fullSchool ?? '' ?></p>
                </div>
                <div class="form-group">
                    <label for="postal">Dirección postal</label>
                    <?php
                    if (Auth::user()->postal_address()) {
                        $fullPostal = Auth::user()->postal_address()->build();
                    }
                    ?>
                    <p><?= $fullPostal ?? '' ?></p>
                </div>

                <div class="form-group">
                    <label for="postal">Dirección física</label>
                    <?php
                    if (Auth::user()->physical_address()) {
                        $fullPhysical = Auth::user()->physical_address()->build();
                    }
                    ?>
                    <p><?= $fullPhysical ?? '' ?></p>
                </div>
            </div>
            <div class="grid-group">
                <h3 class="valid-title"><i class="fas fa-paw"></i> Campamento</h3>
                <div class="form-group">
                    <label for="session">Sesión preferida</label>
                    <?php if (Auth::user()->application()) {
                        $session = Auth::user()->application()->preferred_session(true);
                    } else {
                        $session = '';
                    } ?>

                    <p><?= $session ?>


                    </p>
                </div>

                <div class="form-group">
                    <label for="session">Tamaño de camisa</label>
                    <?php if (Auth::user()->application()) {
                        $size = Auth::user()->application()->shirt_size;
                    } else {
                        $size = '';
                    } ?>

                    <p><?= $size ?>


                    </p>
                </div>
            </div>

            <div class="grid-group">
                <h3 class="valid-title"><i class="fas fa-file"></i> Documentos</h3>
                <div class="form-group">

                    <!-- File submission check -->
                    <p class="file-submitted">
                        <?php if ($application->url_written_application !== null && $application->url_written_application !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Aplicación escrita
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_transcript !== null && $application->url_transcript !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Transcripción de crédito
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_video_essay !== null && $application->url_video_essay !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Ensayo en video
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_written_essay !== null && $application->url_written_essay !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Ensayo escrito
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_authorization_letter !== null && $application->url_authorization_letter !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Carta de autorización
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_recommendation_letter !== null && $application->url_recommendation_letter !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Carta de recomendación
                    </p>

                    <p class="file-submitted">
                        <?php if ($application->url_picture !== null && $application->url_picture !== '') { ?>
                            <span class="doc-ok"><i class="fas fa-check-circle"></i></span>
                        <?php } else { ?>
                            <span class="doc-no"><i class="fas fa-times"></i></span>
                        <?php } ?>
                        Foto
                    </p>


                </div>
            </div>
        </div>

        <div class="form-actions">
            <input type="hidden" name="stage" value="confirm">

            <a href="#" onclick="openModal('confirmSubmitApplicationModal')" class="main-action-bright gradiented">
                <i class="fas fa-arrow-right"></i>
                Someter</a>

            <?php require_once __DIR__ . '../../modals/confirmSubmitApplicationModal.php'; ?>
        </div>
    </form>
</div>


<?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
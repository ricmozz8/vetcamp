<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '../../partials/header.php';
?>

<body>
    <?php require_once(__DIR__ . '../../partials/navbar.php'); ?>


    <div class="application_header">
        <h1>Solicitud</h1>
        <a href="/apply/application/documents" class="main-action-bright"><i class="las la-arrow-left"></i>Atrás</a>
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
            <!-- Confirmation info -->

            <div class="desk-grid">

                <div class="grid-group">
                    <h3>Contacto</h3>
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
                    <h3>Direcciones</h3>
                    <div class="form-group">
                        <label for="postal">Dirección de la escuela</label>
                        <?php
                        if (Auth::user()->school_address()) {
                            $fullPostal = Auth::user()->school_address()->build();
                        }
                        ?>
                        <p><?= $fullPostal ?? '' ?></p>
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
                            $fullPostal = Auth::user()->physical_address()->build();
                        }
                        ?>
                        <p><?= $fullPostal ?? '' ?></p>
                    </div>
                </div>
                <div class="grid-group">
                    <h3>Campamento</h3>
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
                    <h3>Documentos</h3>
                    <div class="form-group">

                        <!-- File submission check -->
                        <p for="file-submitted">
                            <?php if ($application->url_written_application !== null && $application->url_written_application !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Aplicación escrita
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_transcript !== null && $application->url_transcript !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Transcripción de crédito
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_video_essay !== null && $application->url_video_essay !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Ensayo en video
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_written_essay !== null && $application->url_written_essay !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Ensayo escrito
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_authorization_letter !== null && $application->url_authorization_letter !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Carta de autorización
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_recommendation_letter !== null && $application->url_recommendation_letter !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Carta de recomendación
                        </p>

                        <p for="file-submitted">
                            <?php if ($application->url_picture !== null && $application->url_picture !== '') { ?>
                                <i style="color: lightgreen;" class="las la-check"></i>
                            <?php } else { ?>
                                <i style="color:red;" class="las la-times"></i>
                            <?php } ?>
                            Foto
                        </p>


                    </div>
                </div>
            </div>

            <div class="form-actions">
                <input type="hidden" name="stage" value="confirm">

                <a href="#" onclick="openModal('confirmSubmitApplicationModal')" class="main-action-bright gradiented">
                    <i class="las la-arrow-right"></i>
                    Someter</a>

                <?php require_once __DIR__ . '../../modals/confirmSubmitApplicationModal.php'; ?>
            </div>
        </form>
    </div>




    </div>

    <?php require_once(__DIR__ . '../../partials/footer.php'); ?>
</body>

</html>
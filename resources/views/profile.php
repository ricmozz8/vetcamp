<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>


    <body>
        <!-- Main dashboard container -->
        <div class="back-dash">

            <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


            <!-- Main content area -->
            <div class="main-content">

                <!-- Header with welcome message and action button -->

                <div class="profile-wrapper">
                    <a href="/admin/requests" class=" main-action-bright"><i class="las la-arrow-left"></i> Volver</a>

                    <section class="applicant-info">
                        <img src="<?= $application->url_picture ?>" alt="Applicant" class="applicant-photo">
                        <div class="applicant-details">
                            <h1 class="applicant-name"><?= $user->first_name . " " . $user->last_name ?></h1>
                            <p>Solicitud hecha: <?= get_date_spanish($user->created_at) ?></p>
                            <p class="flex">Correo: <a class="no-deco-action" href="mailto:<?= $user->email ?>"><?= $user->email ?></a></p>
                            <p>Teléfono: <?= format_phone($user->phone_number) ?></p>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2>Datos básicos</h2>
                        <div class="data-grid">
                            <div><strong>Dirección Postal</strong>
                                <p>
                                    <?= $postal_address->aline1 . " "
                                        . $postal_address->aline2 . " "
                                        . $postal_address->city . ", "
                                        . $postal_address->zip_code ?>
                                </p>
                            </div>
                            <div><strong>Dirección Física</strong>
                                <p>
                                    <?= $physical_address->aline1 . " "
                                        . $physical_address->aline2 . " "
                                        . $physical_address->city . ", "
                                        . $physical_address->zip_code ?>
                                </p>
                            </div>
                            <div><strong>Escuela de procedencia</strong>
                                <p>
                                    <?= $school_address->street . " "
                                        . $school_address->city . " "
                                        . $school_address->zip_code . " ($school_address->school_type)"
                                    ?>
                                </p>
                            </div>
                            <div><strong>Fecha de Nacimiento</strong>
                                <p><?= get_date_spanish($user->birthdate) ?></p>
                            </div>
                            <div><strong>Edad</strong>
                                <p><?= $user->get_age() ?></p>
                            </div>
                            <div><strong>Sesión Preferida</strong>
                                <p><?= $preferred_session ?></p>
                            </div>
                        </div>
                    </section>
                    <br>
                    <hr><br>
                    <section class="data-section">
                        <h2>Documentos subidos</h2>
                        <div class="documents-grid">
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_written_essay ?>"><i class="las la-file-alt"></i>Ensayo Escrito</a></div>
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_video_essay ?>"><i class="las la-file-alt"></i>Ensayo en Video</a></div>
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_authorization_letter ?>"><i class="las la-file-alt"></i>Carta de Autorización</a></div>
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_transcript ?>"><i class="las la-file-alt"></i>Transcripción de créditos</a></div>
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_written_application ?>"><i class="las la-file-alt"></i>Solicitud Escrita</a></div>
                            <div><a class="main-action-bright no-deco-action" href="<?= $application->url_picture ?>"><i class="las la-file-alt"></i>Foto 2x2</a></div>
                        </div>
                    </section>
                    <br>
                    <hr><br>
                    <section class="manage-section">
                        <form action="/admin/requests/update" method="POST">
                            <input type="hidden" name="application_id" value="<?php echo $application->id_application; ?>">
                            <h2>Manejar Solicitud</h2>
                            <div class="status-options">
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Sometida" <?php echo ($application->status === 'submitted') ? 'checked' : ''; ?>> Sometida
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Necesita Cambios" <?php echo ($application->status === 'need_changes') ? 'checked' : ''; ?>> Necesita Cambios
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Denegada" <?php echo ($application->status === 'denied') ? 'checked' : ''; ?>> Denegada
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Aprobada" <?php echo ($application->status === 'approved') ? 'checked' : ''; ?>> Aprobada
                                </label>
                            </div>

                            <div class="actions">
                                <label>
                                    <input name="notify" type="checkbox"> Notificar al solicitante
                                </label>
                                <button class="main-action-bright" type="submit"><i class="las la-save"></i> Guardar</button>
                            </div>
                        </form>
                    </section>
                </div>
            </div>
        </div>
        <?php include('modals/messageModal.php') ?>


        <?php include('partials/footer.php') ?>

    </body>

</html>

</body>

</html>

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
                        <?php if ($documents['picture'] != null) {
                            $picture = $documents['picture']; ?>
                            <img src="data:<?php echo $picture['type']; ?>;base64,<?php echo base64_encode($picture['contents']); ?>" alt="Applicant" class="applicant-photo">
                        <?php } ?>
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
                            <?php if ($documents['written_essay'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['written_essay']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Ensayo Escrito</a></div>
                            <?php } ?>

                            <?php if ($documents['video_essay'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['video_essay']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Ensayo en Video</a></div>
                            <?php } ?>

                            <?php if ($documents['authorization_letter'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['authorization_letter']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Carta de Autorización</a></div>
                            <?php } ?>

                            <?php if ($documents['transcript'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['transcript']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Transcripción de créditos</a></div>
                            <?php } ?>

                            <? if ($documents['written_application'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['written_application']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Solicitud Escrita</a></div>
                            <? } ?>

                            <? if ($documents['picture'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['picture']['name'] ?>')" class="main-action-bright no-deco-action" href="#"><i class="las la-file-alt"></i>Foto 2x2</a></div>
                            <? } ?>

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
                                    <input type="radio" name="status" value="submitted" <?php echo ($application->status === 'Sometida') ? 'checked' : ''; ?>> Sometida
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="need_changes" <?php echo ($application->status === 'Necesita Cambios') ? 'checked' : ''; ?>> Necesita Cambios
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="denied" <?php echo ($application->status === 'Rechazado') ? 'checked' : ''; ?>> Denegada
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="approved" <?php echo ($application->status === 'Aceptado') ? 'checked' : ''; ?>> Aprobada
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="waitlist" <?php echo ($application->status === 'En lista de espera') ? 'checked' : ''; ?>> En lista de espera
                                </label>
                            </div>
                            <a href="#" class="main-action-bright" onclick="openModal('messageModal')">
                                <i class="las la-envelope"></i>
                                Enviar Mensaje
                            </a>
                            <a href="#" class="main-action-bright" onclick="openModal('exportApplicationModal')">
                                <i class="las la-download"></i>
                                Exportar a Excel
                            </a>

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
        <!-- including here file view popup -->
        <?php foreach ($documents as $file) { ?>
            <?php require(__DIR__ . '/modals/fileViewPopup.php'); ?>
        <?php } ?>



        <?php include('modals/messageModal.php') ?>


        <?php include('partials/footer.php') ?>

    </body>

</html>

</body>

</html>
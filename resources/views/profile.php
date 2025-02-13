<!DOCTYPE html>
<html lang="en">
<?php

require_once __DIR__ . '/partials/header.php';
?>

<body>
<!-- Main dashboard container -->
<div class="back-dash">

    <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


    <!-- Main content area -->
    <div class="main-content">

        <!-- Header with welcome message and action button -->

        <div class="profile-splited-view">

            <div class="profile-wrapper">

                <div class="profile-section-title">
                    <h1>
                        <i class="las la-clipboard"></i>
                        Solicitud
                    </h1>
                    <a href="/admin/requests"
                       class=" plain-action"><i class="las la-arrow-left"></i>Volver a las solicitudes</a>
                </div>


                <div class="profile-padded">

                    <section class="applicant-info">
                        <?php if ($documents['picture'] != null) {
                            $picture = $documents['picture']; ?>
                            <img src="data:<?php echo $picture['type']; ?>;base64,<?php echo base64_encode($picture['contents']); ?>"
                                 alt="Applicant" class="applicant-photo">
                        <?php } ?>
                        <div class="applicant-details">
                            <h1 class="applicant-name"><?= $user->first_name . " " . $user->last_name ?></h1>
                            <p>Solicitud hecha: <?= get_date_spanish($user->created_at) ?></p>
                            <p class="flex">Correo: <a class="no-deco-action"
                                                       href="mailto:<?= $user->email ?>"><?= $user->email ?></a></p>
                            <p>Teléfono: <?= format_phone($user->phone_number) ?></p>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2><i class="las la-info"></i> Datos básicos</h2>
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

                    <section class="data-section">
                        <h2><i class="las la-file"></i> Documentos subidos</h2>
                        <div class="documents-grid">
                            <?php if ($documents['written_essay'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['written_essay']['name'] ?>')"
                                        class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Ensayo
                                        Escrito</a></div>
                            <?php } ?>

                            <?php if ($documents['video_essay'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['video_essay']['name'] ?>')"
                                        class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Ensayo
                                        en Video</a></div>
                            <?php } ?>

                            <?php if ($documents['authorization_letter'] != null) { ?>
                                <div>
                                    <a onclick="showModal('fileViewPopup-<?= $documents['authorization_letter']['name'] ?>')"
                                       class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Carta
                                        de Autorización</a></div>
                            <?php } ?>

                            <?php if ($documents['transcript'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['transcript']['name'] ?>')"
                                        class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Transcripción
                                        de créditos</a></div>
                            <?php } ?>

                            <? if ($documents['written_application'] != null) { ?>
                                <div>
                                    <a onclick="showModal('fileViewPopup-<?= $documents['written_application']['name'] ?>')"
                                       class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Solicitud
                                        Escrita</a></div>
                            <? } ?>

                            <? if ($documents['picture'] != null) { ?>
                                <div><a onclick="showModal('fileViewPopup-<?= $documents['picture']['name'] ?>')"
                                        class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Foto
                                        2x2</a></div>
                            <? } ?>

                            <? if ($documents['recommendation_letter'] != null) { ?>
                                <div>
                                    <a onclick="showModal('fileViewPopup-<?= $documents['recommendation_letter']['name'] ?>')"
                                       class="no-deco-action w-fit" href="#"><i
                                                class="las la-file-alt"></i>Carta
                                        de recomendación</a></div>
                            <? } ?>

                        </div>
                    </section>

                    <?php if ($application->extra_notes) { ?>
                        <section class="extra-notes">
                            <h2><i class="las la-info-circle"></i>
                                El usuario ha indicado:
                            </h2>
                            <p><?= ucfirst($application->extra_notes) ?></p>
                        </section>
                    <?php } ?>


                    <section class="manage-section">
                        <form action="/admin/requests/update" method="POST">
                            <input type="hidden" name="application_id"
                                   value="<?php echo $application->id_application; ?>">
                            <h2>
                                <i class="las la-edit"></i>
                                Manejar Solicitud
                            </h2>

                            <div class="flex-min">
                                <label for="status">Cambiar estado</label>
                                <?php

                                echo renderSelect('status', $statuses, $application->status);
                                ?>
                            </div>
                            <br><br>


                            <div class="actions">
                                <a href="#" class="main-action-bright no-deco-action"
                                   onclick="openModal('exportApplicationModal')">
                                    <i class="las la-download"></i>
                                    Exportar a Excel
                                </a>

                                <a href="#" class="main-action-bright secondary" onclick="openModal('messageModal')">
                                    <i class="las la-envelope"></i>
                                    Enviar Mensaje
                                </a>

                                <button class="main-action-bright primary" type="submit"><i class="las la-save"></i>
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </section>
                </div>


            </div>
            <div class="comment-sidebar">

                <div class="profile-section-title">
                    <h1>
                        <i class="las la-comment"></i>
                        Notas
                    </h1>
                </div>

                <div class="comment-padded">


                    <p class="disclaimer">
                        Las notas solo son visibles para ti y los otros evaluadores. Ningún aplicante podrá ver ninguna nota.
                    </p>


                    <div class="comment-list">

                        <!-- SAMPLE COMMENT CARD -->

                        <?php foreach ($application->comments() as $comment) { ?>

                            <div class="comment-card">
                                <?php $comment_user = $comment->user();

                                $full_name = $comment_user->first_name . ' ' . $comment_user->last_name;
                                $initials = substr($comment_user->first_name, 0, 1) . substr($comment_user->last_name, 0, 1);


                                ?>
                                <div class="comment-head">
                                    <div class="comment-info">
                                        <div class="profile-badge"><?= $initials ?></div>
                                        <div class="user-data">
                                            <h1><?= $full_name ?></h1>
                                            <p><?= get_date_spanish($comment->made_on) ?></p>
                                        </div>
                                    </div>
                                    <?php if ($comment_user->user_id === Auth::user()->user_id) { ?>
                                        <div class="comment-actions">
                                            <a href="#" class="radio-option"><i class="las la-edit"></i></a>
                                            <a href="#" class="radio-option-danger"><i class="las la-trash"></i></a>
                                        </div>
                                    <?php } ?>
                                </div>
                                <div class="comment">
                                    <p><?= $comment->comment ?></p>
                                </div>

                            </div>
                        <?php } ?>

                    </div>

                    <form class="post-comment-form" action="/admin/request/comment" method="POST">
                        <input type="hidden" name="application_id" value="<?php echo $application->id_application; ?>">
                        <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">

                        <label for="comment">
                            <i class="las la-comment"></i>Añade una nota
                        </label>
                        <textarea required name="comment" id="" cols="30" rows="10"
                                  placeholder="Comenta sobre esta solicitud entre los evaluadores..."></textarea>

                        <div class="comment-form-actions">
                            <button class="main-action-bright secondary" type="submit"><i
                                        class="las la-paper-plane"></i>
                                Comenta
                            </button>
                        </div>
                    </form>

                </div>

            </div>
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


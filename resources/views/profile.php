<!DOCTYPE html>
<html lang="en">
<?php

require_once __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main dashboard container -->
    <?php require __DIR__ . '/partials/profileNav.php'; ?>
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


        <!-- Main content area -->
        <div class="main-content">

            <!-- Header with welcome message and action button -->

            <div class="profile-splited-view">

                <div class="profile-wrapper">

                    <div class="profile-section-title sb">

                        <div class="flex-min">
                            <h1>
                                <i class="fas fa-clipboard"></i>
                                Solicitud
                            </h1>
                            <a href="/admin/requests"
                                class=" plain-action"><i class="fas fa-arrow-left"></i>Volver a las solicitudes</a>
                        </div>

                        <abbr style="display: none" id="open-comment" onclick="toggleCommentSection()"
                            title="Mostrar sección de comentarios">
                            <a href="#" class="semi-rounded-action"><i class="fas fa-comment"></i>
                                <?php
                                $comment_count = count($application->comments());
                                if ($comment_count > 0) { ?>
                                    <span class="mini-badge">
                                        <?= $comment_count ?>
                                    </span>
                                <?php } ?>
                            </a>
                        </abbr>
                    </div>


                    <div class="profile-padded">

                        <section class="applicant-info">
                            <?php if (isset($documents['picture'])) {
                                $picture = $documents['picture']; ?>
                                <img src="data:<?php echo $picture['type']; ?>;base64,<?php echo base64_encode($picture['contents']); ?>"
                                    alt="Applicant" class="applicant-photo">
                            <?php } else { ?>
                                <div class="big-actions">
                                    <?php
                                    $badgeUser = $user;
                                    require __DIR__ . '/partials/userBadge.php' ?>

                                </div>
                            <?php } ?>
                            <div class="applicant-details">
                                <h1 class="applicant-name"><?= $user->first_name . " " . $user->last_name ?></h1>
                                <p>Solicitud hecha: <?= get_date_spanish($user->created_at) ?></p>
                                <p class="flex">Correo: <a class="no-deco-action"
                                        href="mailto:<?= $user->email ?>"><?= $user->email ?></a></p>
                                <p>Teléfono: <?= format_phone($user->phone_number) ?></p>
                                <p class="st-badge status-badge-alt-<?= str_replace(' ', '-', strtolower($application->status)) ?>"><?= $application->status ?></p>
                            </div>
                        </section>

                        <section class="data-section">
                            <h2><i class="fas fa-info"></i> Datos básicos</h2>
                            <div class="data-grid">
                                <div></i><strong>Dirección Postal</strong>
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

                                <div><strong>Tamaño de ropa</strong>
                                    <p><?= $application->shirt_size ?></p>
                                </div>
                            </div>
                        </section>

                        <section class="data-section">
                            <h2><i class="fas fa-file"></i> Documentos subidos</h2>
                            <div class="documents-grid">
                                <?php if ($documents) { ?>

                                    <?php foreach ($documents as $document) { ?>
                                        <div><a target="_blank" href="/admin/document?a=<?= $application->id_application ?>&d=<?= substr($document['name'], 0, strrpos($document['name'], '.')) ?>"
                                                class="no-deco-action w-fit" href="#">
                                                    <?= $document['name'] ?>
                                                </a>
                                            </div>
                                    <?php }; ?>


                                <?php }; ?>

                            </div>
                        </section>

                        <?php if ($application->extra_notes) { ?>
                            <section class="extra-notes">
                                <h2><i class="fas fa-comment"></i>
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
                                    <i class="fas fa-edit"></i>
                                    Manejar Solicitud
                                </h2>

                                <div class="flex-min">
                                    <label style="min-width: max-content;" for="status">Cambiar estado</label>


                                    <?php
                                    $selectOptions = $statuses;
                                    if ($application->status !== 'Matriculado') {
                                        unset($selectOptions['enrolled']);
                                    }
                                    $selectedValue = $application->status;
                                    $disabled = $application->status === 'Matriculado';
                                    echo renderSelect('status', $selectOptions, $selectedValue, [], $disabled);
                                    ?>
                                </div>
                                <br><br>


                                <div class="actions">
                                    <a href="#" class="main-action-bright"
                                        onclick="openModal('exportApplicationModal')">
                                        <i class="fas fa-download"></i>
                                        Descargar copia local
                                    </a>

                                    <a href="#" class="main-action-bright secondary" onclick="openModal('messageModal')">
                                        <i class="fas fa-envelope"></i>
                                        Enviar Mensaje
                                    </a>

                                    <?php if ($application->status !== 'Matriculado') { ?>
                                    <button class="main-action-bright primary" type="submit"><i class="fas fa-save"></i>
                                        Guardar
                                    </button>
                                    <?php } ?>
                                </div>
                            </form>
                        </section>
                    </div>


                </div>
                <div class="comment-sidebar" id="comment-section">

                    <div class="profile-section-title sb">
                        <h1>
                            <i class="fas fa-comment"></i>
                            Notas
                        </h1>

                        <abbr title="Ocultar sección de comentarios">
                            <a href="#" onclick="toggleCommentSection()" class="semi-rounded-action">
                                <i class="fas fa-eye-slash"></i>
                            </a>
                        </abbr>
                    </div>

                    <div class="comment-padded">


                        <p class="disclaimer">
                            Las notas solo son visibles para ti y los otros evaluadores. Ningún aplicante podrá ver ninguna
                            nota.
                        </p>


                        <div class="comment-list">


                            <?php
                            $loop = 1;
                            foreach ($application->comments() as $comment) { ?>

                                <div class="comment-card">
                                    <?php $comment_user = $comment->user();

                                    $full_name = $comment_user->first_name . ' ' . $comment_user->last_name;
                                    $isUserOP = $comment_user->user_id === Auth::user()->user_id;

                                    ?>
                                    <div class="comment-head">
                                        <div class="comment-info">
                                            <?php
                                            $badgeUser = $comment_user;
                                            require __DIR__ . '/partials/userBadge.php'
                                            ?>
                                            <div class="user-data">
                                                <h1><?= $full_name ?></h1>
                                                <p><?= get_date_spanish($comment->made_on) ?> <?= $comment->edited ? '(Editado)' : '' ?></p>

                                            </div>
                                        </div>
                                        <?php if ($isUserOP) { ?>
                                            <div class="comment-actions">
                                                <a onclick="openModal('editCommentModal-<?= $loop ?>' )" href="#"
                                                    class="radio-option"><i class="fas fa-edit"></i></a>
                                                <a onclick="openModal('deleteCommentModal-<?= $loop ?>' )" href="#"
                                                    class="radio-option-danger"><i class="fas fa-trash"></i></a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="comment">
                                        <p><?= $comment->comment ?></p>
                                    </div>

                                </div>

                                <?php
                                if ($isUserOP) {
                                    require __DIR__ . '/modals/deleteCommentModal.php';
                                    require __DIR__ . '/modals/editCommentModal.php';
                                }
                                $loop++;
                                ?>


                            <?php } ?>

                        </div>

                        <form class="post-comment-form" action="/admin/request/comment" method="POST">
                            <input type="hidden" name="application_id" value="<?php echo $application->id_application; ?>">
                            <input type="hidden" name="user_id" value="<?php echo $user->user_id; ?>">

                            <label for="comment" style="display: flex; align-items: center; gap: 5px">
                                <i class="fas fa-comment"></i>
                                <p>Añade una nota</p>
                            </label>
                            <textarea required name="comment" id="" cols="30" rows="10"
                                placeholder="Comenta sobre esta solicitud entre los evaluadores..."></textarea>

                            <div class="comment-form-actions">
                                <button class="main-action-bright secondary" type="submit"><i
                                        class="fas fa-paper-plane"></i>
                                    Comenta
                                </button>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        let comment_section = document.getElementById('comment-section');
        let open_comment = document.getElementById('open-comment');

        let comment_opened = true;

        // this saves the option when the user wants to close the comment section (always hide)
        document.addEventListener('DOMContentLoaded', function() {

            if (document.cookie.includes('prefers_closed_comments=true')) {
                comment_opened = false;
                open_comment.style.display = 'block';
                comment_section.style.display = 'none';

            } else {
                comment_opened = true;
                open_comment.style.display = 'none';
                comment_section.style.display = 'block';
                document.cookie = "prefers_closed_comments=false; path=/";
            }

        })

        function toggleCommentSection() {
            if (comment_opened) {
                comment_section.style.display = 'none';
                comment_opened = false;
                open_comment.style.display = 'block';
                document.cookie = "prefers_closed_comments=true; path=/";

            } else {
                comment_section.style.display = 'block';
                comment_opened = true;
                open_comment.style.display = 'none';
                document.cookie = "prefers_closed_comments=false; path=/";
            }


        }
    </script>


    <?php include('modals/messageModal.php') ?>
    <?php include('modals/exportApplicationModal.php') ?>


    <?php include('partials/footer.php') ?>

</body>

</html>
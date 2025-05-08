<div id="manageSessionModal-<?= $modal_session_class ?? '' ?>" class="modal">
    <div class="modal-content">

        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('manageSessionModal-<?= $modal_session_class ?? '' ?>')">
            <i class="fas fa-times"></i>
        </span>
        <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-user-cog"></i>
            Manejar sesión (<?= $session['title'] ?>)
        </h2>
        <?php $loop = 1; ?>
        <form action="/admin/unenroll" method="POST">

            <div class="form-group">
                <label for="students">Estudiantes</label>
                <div class="multiselect">
                    <div id="checkboxesManageSessionModal-<?= $modal_session_class ?? '' ?>" class="checkboxes">
                        <?php if (empty($session['students'])): ?>
                            <p class="multiselect-item" style=" color: gray;">No hay estudiantes en esta sesión.</p>
                        <?php endif; ?>
                        <?php foreach ($session['students'] as $student) { ?>
                            <div class="multiselect-item">
                                <input type="checkbox" name="students[]" value="<?= $student->user_id ?>">
                                <?php
                                $profile = $student->application()->getProfilePicture();
                                $src = "";
                                if ($profile) {
                                    $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                                }
                                ?>



                                <div class="multiselect-item-info">
                                    <div class="profile-main">
                                        <?php if ($profile): ?>
                                            <img src="<?= $src ?>" alt="Imagen de <?= $student->first_name . ' ' . $student->last_name ?>">
                                        <?php else: ?>
                                            <?php
                                            $badgeUser = $student;
                                            require __DIR__ . '/../partials/userBadge.php';
                                            ?>
                                        <?php endif; ?>
                                        <div class="profile-secondary">
                                            <h1><?= $student->first_name . ' ' . $student->last_name ?></h1>
                                            <p><?= $student->email ?></p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <?php }; ?>
                    </div>

                </div>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('manageSessionModal-<?= $modal_session_class ?? '' ?>')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-user-times"></i>
                    Desmatricular
                </button>
            </div>


        </form>
    </div>
</div>
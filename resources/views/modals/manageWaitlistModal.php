<div id="manageWaitlistModal" class="modal">
    <div class="modal-content">



        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('manageWaitlistModal')">
            <i class="fas fa-times"></i>
        </span>
        <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-user-cog"></i>
            Manejar Lista de espera
        </h2>
        <?php $loop = 1; ?>
        <form action="/admin/unenroll" method="POST">

            <input type="hidden" name="is_waitlist" value="waitlist">

            <div class="form-group">
                <label for="students">Estudiantes</label>
                <div class="multiselect">
                    <div id="checkboxesmanageWaitlistModal" class="checkboxes">
                        <?php if (empty($waitlist)): ?>
                            <p class="multiselect-item" style=" color: gray;">No hay estudiantes en esta sesión.</p>
                        <?php endif; ?>
                        <?php foreach ($waitlist as $application) { ?>
                            <div class="multiselect-item">
                                <input type="checkbox" name="students[]" value="<?= $application->user_id ?>">
                                <?php
                                $profile = $application->getProfilePicture();
                                $src = "";
                                $student = $application->user();
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
                <a class="main-action-bright" onclick="closeModal('manageWaitlistModal')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-user-times"></i>
                    Quitar
                </button>
            </div>


        </form>
    </div>
</div>

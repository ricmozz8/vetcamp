<div id="enrollStudentsModal" class="modal">
    <div class="modal-content">

        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('enrollStudentsModal')">
            <i class="fas fa-times"></i>
        </span>
        <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-user-plus"></i>
            Matricular estudiantes
        </h2>
        <?php $loop = 1; ?>
        <form action="/admin/enroll" method="POST">

            <div class="form-group">
                <label for="session">Sesión</label>
                <select name="session" id="session" required>
                    <option value="" disabled selected>Seleccione una sesión</option>
                    <?php foreach ($sessions as $sessionName => $users) { ?>
                        <option value="<?= $loop ?>"><?php echo $sessionName; ?></option>
                    <?php $loop++; ?>
                    <?php }; ?>
                    <option value="waitlist">Lista de espera</option>
                </select>
            </div>

            <div class="form-group">
                <label for="students">Estudiantes</label>
                <div class="multiselect">
                    <?php foreach ($approvedPool as $user) {
                    ?>
                        <div class="multiselect-item">
                            <input type="checkbox" name="students[]" value="<?= $user->user_id ?>">
                            <?php
                            $profile = $user->getProfilePicture();
                            $src = "";
                            if ($profile) {
                                $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                            }
                            ?>



                            <div class="multiselect-item-info">
                                <div class="profile-main">
                                    <?php if ($profile): ?>
                                        <img src="<?= $src ?>" alt="Imagen de <?= $user->first_name . ' ' . $user->last_name ?>">
                                    <?php else: ?>
                                        <?php
                                        $badgeUser = $user;
                                        require __DIR__ . '/../partials/userBadge.php';
                                        ?>
                                    <?php endif; ?>
                                    <div class="profile-secondary">
                                        <h1><?= $user->first_name . ' ' . $user->last_name ?></h1>
                                        <p><?= $user->email ?></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    <?php }; ?>
                </div>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('enrollStudentsModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary">
                    <i class="fas fa-user-plus"></i>
                    Matricular
                </button>
            </div>


        </form>
    </div>
</div>
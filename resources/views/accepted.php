<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>
<?php require_once('partials/profileNav.php'); ?>
<div class="back-dash">

    <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

    <a onclick="openModal('sidebar')" href="#" class="openSidebar">
        <i class="fas fa-bars"></i>
    </a>


    <main class="main-content">
        <header class="header">
            <h1 class="welcome"> Matrícula </h1>
            <button class="main-action-bright primary" onclick="openModal('massiveEmailModal')">
                <i class="fas fa-envelope"></i>
                Enviar mensaje
            </button>
        </header>

        
        <?php if (empty($sessions)): ?>
            <p style="color: gray; text-align: center; font-size: 18px; max-width: 700px; margin: auto; padding: 1em">
                No hay usuarios aceptados.
            </p>
        <?php endif; ?>

        <div class="accepted-grouped">
            <?php foreach ($sessions as $sessionName => $users): ?>
                <div class="accepted-card">
                    <div class="accepted-card-header">
                        <div>
                            <h2 class="accepted-card-title">Sesión <?= htmlspecialchars($sessionName) ?></h2>
                            <p>
                                <i class="fas fa-users"></i>
                                <?= count($users) ?>/14 estudiantes
                            </p>
                        </div>
                        <button class="main-action-bright secondary">
                            <i class="fas fa-envelope"></i>
                            Enviar correo
                        </button>
                    </div>
                    <div class="accepted-card-list">
                        <?php if (empty($users)): ?>
                            <p style="text-align: center; color: gray;">No hay estudiantes en esta sesión.</p>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <div class="accepted-user-card">
                                    <a href="/admin/p?user=<?= $user['user_id'] ?>&from=accepted">
                                    <img src="<?= $user['profile_picture'] ?>"
                                         alt="Imagen de <?= $user['full_name'] ?>">
                                    </a>
                                    <h3><?= $user['full_name'] ?></h3>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php require_once('modals/sendMassiveMailModal.php');?>


    <div class="accepted-grouped">
    <div class="accepted-card centered-card">
        <div class="accepted-card-header">
            <div>
                <h2 class="accepted-card-title">Estudiantes en espera</h2>
                <p>
                    <i class="fas fa-users"></i>
                    <?= count($waitingUsers) ?> estudiantes
                </p>
            </div>
        </div>
        <div class="accepted-card-list">
            <?php if (empty($waitingUsers)): ?>
                <p style="text-align: center; color: gray;">No hay estudiantes en espera.</p>
            <?php else: ?>
                <?php foreach ($waitingUsers as $user): ?>
                    <div class="accepted-user-card">
                        <a href="/admin/p?user=<?= $user['user_id'] ?>&from=accepted">
                        <img src="<?= $user['profile_picture'] ?>"
                             alt="Imagen de <?= $user['full_name'] ?>">
                        </a>
                        <h3><?= $user['full_name'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<div class="accepted-grouped">
    <div class="accepted-card">
        <div class="accepted-card-header">
            <div>
                <h2 class="accepted-card-title">Solicitantes actuales</h2>
                <p>
                    <i class="fas fa-users"></i>
                    <?= count($applicants) ?> solicitantes
                </p>
            </div>
        </div>
        <div class="accepted-card-list">
            <?php if (empty($applicants)): ?>
                <p style="text-align: center; color: gray;">No hay solicitantes actuales.</p>
            <?php else: ?>
                <?php foreach ($applicants as $applicant): ?>
                    <div class="accepted-user-card">
                        <a href="/admin/p?user=<?= $applicant['user_id'] ?>&from=accepted">
                        <img src="<?= $applicant['profile_picture'] ?>"
                             alt="Imagen de <?= $applicant['full_name'] ?>">
                        </a>
                        <h3><?= $applicant['full_name'] ?></h3>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</div>





<?php require_once('partials/footer.php'); ?>
</body>

</html>
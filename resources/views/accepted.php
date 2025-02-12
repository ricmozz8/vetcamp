<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <a onclick="openModal('sidebar')" href="#" class="openSidebar">
            <i class="las la-bars"></i>
        </a>

        <main class="main-content">
            <header class="header">
                <h1 class="welcome"> Aceptados </h1>
                <button class="main-action-bright" onclick="openModal('massiveEmailModal')">
                    <i class="las la-envelope"></i>
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
                            <h2 class="accepted-card-title"><?= htmlspecialchars($sessionName) ?></h2>
                            <p>
                                <i class="las la-users"></i>
                                <?= count($users) ?>/14 estudiantes
                            </p>
                        </div>
                        <button class="main-action-bright">
                            <i class="las la-envelope"></i>
                            Enviar correo
                        </button>
                    </div>
                    <div class="accepted-card-list">
                        <?php if (empty($users)): ?>
                            <p style="text-align: center; color: gray;">No hay estudiantes en esta sesión.</p>
                        <?php else: ?>
                            <?php foreach ($users as $user): ?>
                                <div class="accepted-user-card">
                                    <img src="<?= $user['profile_picture'] ?>" alt="Imagen de <?= $user['full_name'] ?>">
                                    <h3><?= $user['full_name'] . '<a class="main-action-bright no-deco-action" href="requests/r?id=' . $user['user_id'] . '" class="review-link">revisar</a>' ?></h3>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <?php require_once('modals/sendMassiveMailModal.php'); ?>
        </main>
    </div>

    <?php require_once('partials/footer.php'); ?>
</body>

</html>

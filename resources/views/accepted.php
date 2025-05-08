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
                <div class="flex-min">
                    <button onclick="openModal('massiveEmailModal')" class="main-action-bright secondary"><i
                            class="fas fa-envelope"></i> Enviar mensaje</button>
                </div>
            </header>

            <div class="accepted-card">
                <div class="accepted-card-header">
                    <h2 class="accepted-card-title"><i class="fas fa-user-check"></i> Aceptados</h2>
                </div>

                <div class="accepted-card-list">
                    <?php if (empty($approvedPool)): ?>
                        <p
                            style="color: gray; text-align: center; font-size: 18px; max-width: 700px; margin: auto; padding: 1em">
                            No hay usuarios aceptados.
                        </p>
                    <?php endif; ?>
                    <?php foreach ($approvedPool as $user): ?>
                        <div class="accepted-user-card">
                            <a href="/admin/p?user=<?= $user->user_id ?>&from=accepted">
                                <div class="accepted-user-card-header flex">
                                    <?php
                                    $src = "";

                                    $profile = $user->getProfilePicture();
                                    if ($profile) {
                                        $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);

                                    ?>
                                        <img src="<?= $src ?>" alt="profile-picture">

                                    <?php } else { ?>
                                        <?php
                                        $badgeUser = $user;
                                        require 'partials/userBadge.php';
                                        ?>
                                    <?php } ?>
                                    <div class="accepted-user-card-info">
                                        <h3><?= $user->first_name . ' ' . $user->last_name ?></h3>
                                        <p><?= $user->email ?></p>
                                    </div>
                                    </h3>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>




            <div class="accepted-grouped">
                <?php $loop = 1; ?>
                <?php foreach ($sessions as $session) {
                ?>
                    <div class="accepted-card">
                        <div class="accepted-card-header">
                            <div>
                                <h2 class="accepted-card-title"><?= $session['title'] ?></h2>
                                <p>
                                    <i class="fas fa-users"></i>
                                    <?= count(($session['students'])) ?>/14
                                    estudiantes
                                </p>
                            </div>

                            <div class="flex-min">

                                <!-- UNENROLL MODAL BUTTON -->
                                <button onclick="openModal('manageSessionModal-<?= $session['id'] ?>')"
                                    class="main-action-bright plain-action">
                                    <i class="fas fa-cog"></i>
                                </button>

                                <!-- MAIL USERS ON SESSION MODAL -->
                                <button onclick="openModal('sendSessionMailModal-<?= $session['id'] ?>')"
                                    class="main-action-bright secondary">
                                    <i class="fas fa-envelope"></i>

                                </button>

                                <!-- ENROLL MODAL BUTTON -->
                                <button onclick="openEnrollModal('enrollStudentsModal', <?= $session['id'] ?>)"
                                    class="main-action-bright primary">
                                    <i class="fas fa-user-plus"></i>

                                </button>
                                <?php $loop++; ?>
                            </div>
                        </div>
                        <div class="accepted-card-list">
                            <?php if (empty($session['students'])): ?>
                                <p style=" color: gray;">No hay estudiantes en esta sesión.</p>
                            <?php else: ?>
                                <?php foreach ($session['students'] as $user) {
                                    $src = '';

                                    $profile = $user->application()->getProfilePicture();
                                    if ($profile) {
                                        $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                                    }
                                ?>

                                    <div class="accepted-user-card">
                                        <a href="/admin/p?user=<?= $user->user_id ?>&from=accepted">
                                            <?php if (!empty($src)): ?>
                                                <img src="<?= $src ?>"
                                                    alt="Imagen de <?= $user->first_name . ' ' . $user->last_name ?>">
                                            <?php else: ?>
                                                <?php
                                                $badgeUser = $user;
                                                require 'partials/userBadge.php';
                                                ?>
                                            <?php endif; ?>
                                        </a>
                                        <div class="accepted-user-card-info">
                                            <h3><?= $user->first_name . ' ' . $user->last_name ?></h3>
                                            <p><?= $user->email ?></p>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php endif; ?>
                        </div>

                        <?php if (count($session['students']) > 14): ?>
                            <div class="warning-box">
                                <i class="fas fa-exclamation"></i>
                                Tienes más de 14 estudiantes en esta sesión.
                            </div>
                        <?php endif; ?>
                    </div>
                <?php }; ?>
            </div>

            <!-- WAITLIST QUEUE -->

            <div class="accepted-card">
                <div class="accepted-card-header">
                    <h2 class="accepted-card-title"><i class="fas fa-user-clock"></i> Lista de espera</h2>
                    <div class="flex-min">
                        <!-- UNENROLL MODAL BUTTON -->
                        <button onclick="openModal('manageWaitlistModal')"
                            class="main-action-bright plain-action">
                            <i class="fas fa-cog"></i>
                        </button>

                        </button>

                        <button onclick="openEnrollModal('enrollStudentsModal', 'waitlist')"
                            class="main-action-bright primary"><i class="fas fa-user-plus"></i>
                        </button>
                    </div>
                </div>

                <div class="accepted-card-list">
                    <?php if (empty($waitlist)): ?>
                        <p style="color: gray;  font-size: 18px; max-width: 700px; padding: 1em">
                            No hay usuarios en espera.
                        </p>
                    <?php endif; ?>
                    <?php foreach ($waitlist as $application):
                        $user = $application->user();
                    ?>
                        <div class="accepted-user-card">
                            <a href="/admin/p?user=<?= $application->user_id ?>&from=accepted">
                                <div class="accepted-user-card-header flex">
                                    <?php
                                    $profile = $application->getProfilePicture();
                                    if ($profile) {
                                        $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                                        echo "<img src='$src' alt='Imagen de $user->first_name $user->last_name'>";
                                    } else {
                                        $badgeUser = $user;
                                        require 'partials/userBadge.php';
                                    }
                                    ?>
                                    <div class="accepted-user-card-info">
                                        <h3><?= $user->first_name . ' ' . $user->last_name ?></h3>
                                        <p><?= $user->email ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>


            <?php require_once('modals/enrollStudentsModal.php'); ?>
            <?php require_once('modals/sendMassiveMailModal.php'); ?>





        </main>
    </div>

    <?php require_once('partials/footer.php'); ?>
    <?php require_once('modals/manageWaitlistModal.php'); ?>
    <?php array_walk($sessions, function ($session) {
        $modal_session_class = "{$session['id']}";
        require("modals/manageSessionModal.php");
        require('modals/sendSessionMailModal.php');
    }); ?>





</body>

</html>
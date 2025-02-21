<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';

// greeting personalizer by time of day (SPANISH-PR)


$hour = date('G');
if ($hour >= 5 && $hour < 12) {
    $greeting = 'Buenos días';
} elseif ($hour >= 12 && $hour < 18) {
    $greeting = 'Buenas tardes';
} else {
    $greeting = 'Buenas noches';
}
?>

<body>
<!-- Main dashboard container -->

<?php require_once('partials/profileNav.php'); ?>

<div class="back-dash">
    <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


    <!-- Main content area -->
    <div class="main-content">

        <a onclick="openModal('sidebar')" href="#" class="openSidebar">
            <i class="fas fa-bars">
            </i>
        </a>

        <!-- Header with welcome message and action button -->
        <header class="header">

            <h1 class="welcome"><?= $greeting ?>, <?= Auth::user()->first_name ?></h1>
            <button class="main-action-bright primary" onclick="openModal('massiveEmailModal')">
                <i class="fas fa-envelope"></i>
                Enviar mensaje
            </button>
        </header>


        <!-- Statistics grid section -->
        <div class="stats-grid-3 ">
            <!-- Applicants stats card -->
            <div class="stat-card">
                <div class="stat-header">
                    <h2 class="stat-title">
                        <i class="fas fa-id-badge"></i>
                        Solicitantes
                    </h2>

                </div>
                <div class="stat-number"><?php echo $all_applicants; ?></div>
                <p class="stat-description">Usuarios que han llenado el formulario, y que han sometido su solicitud para
                    evaluación.</p>


            </div>

            <!-- Registered users stats card -->
            <div class="stat-card">
                <div class="stat-header">
                    <h2 class="stat-title">
                        <i class="fas fa-user-friends"></i>
                        Registrados

                    </h2>

                </div>
                <div class="stat-number"><?php echo $all_users; ?></div>
                <p class="stat-description">Usuarios que se han registrado en Vetcamp</p>


            </div>

            <!-- Interested users stats card -->
            <div class="stat-card">
                <div class="stat-header">
                    <h2 class="stat-title">
                        <i class="fas fa-paw"></i>
                        Interesados en el campamento

                    </h2>

                </div>
                <div class="stat-number"><?php echo $interested; ?></div>
                <p class="stat-description">Usuarios que han llenado el formulario, pero que no la han sometido.
                    (Interesados en aplicar)</p>

            </div>


        </div>

        <!-- Recent activity section -->
        <div class="stats-grid">

            <!-- Recent applications card -->
            <div class="stat-card">
                <h2 class="stat-title">Solicitudes más recientes</h2>
                <br>

                <div class="recent-list">
                    <?php
                    foreach ($recent_applications as $user) {

                        if (!$user->application()->isComplete()) {
                            continue;
                        }


                        // Get the full name
                        $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name . ' ');
                        $pictureObj = $user->application()->getProfilePicture();
                        $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

                        ?>
                        <div class='recent-application'>
                            <a href="/admin/p?user=<?= $user->user_id ?>"><img src="<?php echo $src; ?>" alt="Image"
                                                                               class="profile-picture"></a>
                            <td><?php echo $full_name; ?></td>
                            <td><?php echo htmlspecialchars($user->email); ?></td>
                        </div>
                    <?php } ?>
                </div>

                <div class="button-container">
                    <a href="/admin/requests" class="secondary main-action-bright">Ver todos</a>
                </div>
            </div>

            <!-- Recent registrations card -->
            <div class="stat-card">
                <h2 class="stat-title">Registros Recientes</h2>
                <br>

                <div class="recent-list">
                    <?php foreach ($recent_registered as $user): ?>
                        <div class="recent-registered">

                            <div class="flex-min">

                                <a href="/admin/p?user=<?= $user->__get('user_id') ?>">
                                    <?php
                                    $application = $user->application();
                                    $hasPhoto = $application && $application->url_picture;

                                    if ($hasPhoto) {
                                        $profile = $application->getProfilePicture();
                                        $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                                        ?>
                                        <img src="<?= $src ?>" alt="Foto de perfil de <?= $full_name ?>"
                                             class="profile-picture">
                                    <?php } else {
                                        $badgeUser = $user;
                                        require __DIR__ . '/partials/userBadge.php';
                                    }

                                    ?>
                                </a>

                                <span class="recent-email"><?php echo $user->email; ?></span>
                            </div>
                            <span class="time-stamp"><?php echo $user->created_at; ?></span>
                            <!-- Will update soon... $user->formatted_created_at -->
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="button-container">
                    <a href="/admin/registered" class="secondary main-action-bright">Ver todos</a>
                </div>
            </div>
        </div>

        <!-- Massive Email Modal -->
        <?php require_once('modals/sendMassiveMailModal.php'); ?>
    </div>
</div>


<?php require_once('partials/footer.php'); ?>

</body>

</html>
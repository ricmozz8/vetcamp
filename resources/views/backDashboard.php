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
    <div style="padding: .5rem; text-align:center; background:black; color:white;">
        Aviso: La implementación del backend todavía <b class="bold">se encuentra
        en desarrollo</b>, algunas partes podrían estar incompletas.
    </div>
    <div class="back-dash">

    


        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>


        <!-- Main content area -->
        <div class="main-content">

            <a onclick="openModal('sidebar')" href="#" class="openSidebar">
                <i class="las la-bars">
                </i>
            </a>

            <!-- Header with welcome message and action button -->
            <header class="header">

                <h1 class="welcome"><?= $greeting ?>, <?= Auth::user()->first_name ?></h1>
                <button class="main-action-bright" onclick="openModal('massiveEmailModal')">
                    <i class="las la-envelope"></i>
                    Enviar mensaje
                </button>
            </header>


            <!-- Statistics grid section -->
            <div class="stats-grid">
                <!-- Applicants stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">
                            <i class="las la-id-badge"></i>
                            Solicitantes
                        </h2>

                    </div>
                    <div class="stat-number"><?php echo $all_applicants; ?></div>

                </div>

                <!-- Registered users stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">
                            <i class="las la-user-friends"></i>
                            Registrados

                        </h2>

                    </div>
                    <div class="stat-number"><?php echo $all_users; ?></div>

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
                        foreach ($recent_applications as $application) {

                            if ($application->application()->isComplete() == false) {
                                continue;
                            }


                            // Get the full name
                            $full_name = htmlspecialchars($application->first_name . ' ' . $application->last_name . ' ');
                            $pictureObj = $application->application()->getProfilePicture();
                            $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

                            echo "<div class='recent-application'>";
                            echo "<img src=\"$src\" alt=\"Image\" class=\"profile-picture\">";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($application->email) . "</td>";
                            echo "</div>";
                        }
                        ?>
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
                                <span class="recent-email"><?php echo $user->email; ?></span>
                                <span class="time-stamp"><?php echo $user->created_at; ?></span> <!-- Will update soon... $user->formatted_created_at -->
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
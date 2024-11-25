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
    <div class="back-dash">
        
        
        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>
        
        
         <!-- Main content area -->
        <div class="main-content">

            
            
            <!-- Header with welcome message and action button -->
            <header class="header">
                <h1 class="welcome"><?= $greeting ?>, <?= Auth::user()->first_name ?></h1>
                    <button class="main-action-bright" id="openModalButton">
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
                        Solicitantes</h2>
                        
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
                                // Get the full name
                                $full_name = htmlspecialchars($application->first_name . ' ' . $application->last_name . ' ');

                                echo "<div class='recent-application'>";
                                echo "<img src=" . htmlspecialchars($application->application()->url_picture) . " alt='Profile Picture' class='avatar';>";
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
        
                    <!-- Modal Popup -->
                    <!-- The overlay provides a semi-transparent dark background behind the popup -->
                    <div class="popup-overlay" id="popupOverlay" style="display: none"></div>

                    <!-- Main popup container with the form -->
                     
                    <div class="message-popup" id="messagePopup" style="display: none">
                        <!-- Close button in the top-right corner -->
                        <a href="#" class="plain-action" id="closePopup"><i class="las la-times"></i></a>
                        
                        <!-- Popup title -->
                        <h2 class="message-title">Enviar mensaje</h2>

                        <!-- Message filter options -->
                        <div class="message-options">
                            <!-- Filter buttons for different message states -->
                            <button id="approvedButton" class="option-button">
                                <div class="option-indicator">
                                    <div class="indicator-dot"></div>
                                </div>
                                <span class="option-text">Aprobados</span>
                            </button>
                            <button class="option-button" id="deniedButton">
                                <div class="option-indicator">
                                    <div class="indicator-dot"></div>
                                </div>
                                <span class="option-text">Denegados</span>
                            </button>
                            <button class="option-button" id="allButton">
                                <div class="option-indicator">
                                    <div class="indicator-dot"></div>
                                </div>
                                <span class="option-text">Todos</span>
                            </button>


                            <select class="form-rounded" name="section" id="sectionDropdown" style="display: none;">
                                <option value="">Seleccione una sección</option>
                                <option value="1">Sección 1</option>
                                <option value="2">Sección 2</option>
                                <option value="3">Sección 3</option>
                                <option value="4">Sección 4</option>
                            </select>
                        </div>

                        <!-- Preset message option -->
                        <label class="preset-message">
                            <input type="checkbox" class="preset-checkbox" id="usePresetMessage">
                            <span>Utilizar Mensajes Predefinidos</span>
                        </label>

                        <!-- Message input area -->
                        <textarea class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"></textarea>

                        <!-- Send button -->
                        <button class="secondary main-action-bright" id="sendButton">Enviar</button>
                    </div>
        </div>
    </div>

    <script src="<? web_resource("js/backendDashboard.js")?>"></script>

    <?php require_once('partials/footer.php'); ?>

</body>
</html>
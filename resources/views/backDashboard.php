<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main dashboard container -->
    <div class="back-dash">
        
        <!-- Sidebar navigation -->
        <aside class="sidebar">
            <!-- Logo section -->
            <div class="logo-container">
                <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
            </div>
            
            <!-- Main navigation menu -->
            <nav class="nav-links">
                <a href="/admin" class="nav-item active">
                    <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                    <span>Inicio</span>
                </a>
                <a href="/admin/requests" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                    <span>Solicitudes</span>
                </a>
                <a href="/admin/registered" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                    <span>Registrados</span>
                </a>
                <a href="/admin/settings" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                    <span>Ajustes</span>
                </a>
            </nav>

            <!-- User profile section -->
            <div class="user-profile">
                <!-- <div class="user-avatar" id="userAvatar"><img src="<?php echo Auth::user()->url_picture; ?>"></div> -->
                <div class="user-info">
                    <span class="user-email" id="userEmail"><?php echo Auth::user()->email; ?></span>
                    <a href="#" class="logout">Salir</a>
                </div>
            </div>
        </aside>

        
         <!-- Main content area -->
        <div class="main-content">
            <!-- Secondary logo container -->
            <div class="logo-container">
                <img src="/resources/assets/logo/SVG/vetcamp_full_hoz_b.svg" alt="Vetcamp" class="logo logo-right">
            </div>
            
            <!-- Header with welcome message and action button -->
            <header class="header">
                <h1 class="welcome">Bienvenido, Usuario</h1>
                    <button class="tertiary main-action-bright" id="openModalButton"><img src="https://img.icons8.com/?size=100&id=UpjOluXJf7xW&format=png&color=FFFFFF" class="main-icons">Enviar mensaje</button>
            </header>
            
            
            <!-- Statistics grid section -->
            <div class="stats-grid">
                <!-- Applicants stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">Solicitantes</h2>
                        <a href="/admin/requests" class="view-all">ver todos</a>
                    </div>
                    <div class="stat-number"><?php echo $all_applicants; ?></div>
                       <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="main-icons">
                </div>

                <!-- Registered users stats card -->
                <div class="stat-card">
                    <div class="stat-header">
                        <h2 class="stat-title">Registrados</h2>
                        <a href="/admin/registered" class="view-all">ver todos</a>
                    </div>
                    <div class="stat-number"><?php echo $all_users; ?></div>
                       <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="main-icons">
                </div>
            </div>

            <!-- Recent activity section -->
            <div class="stats-grid">

                <!-- Recent applications card -->
                <div class="stat-card">
                    <h2 class="stat-title">Solicitudes más recientes</h2>
                    <br>

                    <div class="recent-list">
                        <?php foreach ($recent_applications as $application): ?>
                        <div class="recent-application">
                                <img src="<?php echo $application->url_picture; ?>" alt="" class="avatar">
                            <div class="recent-info">
                                <span class="recent-name"><?php echo $application->first_name;?> <?php echo $application->last_name;?></span>
                                <span class="recent-email"><?php echo $application->email; ?></span>
                            </div>
                        </div>
                        <?php endforeach; ?>
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
                            <span class="time-stamp"><?php echo $user->formatted_created_at; ?></span>
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

    <script src="<?= web_resource("js/backendDashboard.js")?>"></script>

    <?php require_once('partials/footer.php'); ?>

</body>
</html>
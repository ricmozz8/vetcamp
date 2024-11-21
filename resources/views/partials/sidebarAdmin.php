<!-- Sidebar navigation -->
<aside class="sidebar">
        <!-- Logo section -->
        <div class="logo-container">
                <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
        </div>

        <!-- Main navigation menu -->
        <nav class="nav-links">
                <a href="/admin" class="nav-item <?php if ($selected == 'start') { echo 'active'; } ?>">
                        <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                        <span>Inicio</span>
                </a>
                <a href="/admin/requests" class="nav-item <?php if ($selected == 'requests') { echo 'active'; } ?>">
                        <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                        <span>Solicitudes</span>
                </a>
                <a href="/admin/registered" class="nav-item <?php if ($selected == 'registered') { echo 'active'; } ?>">
                        <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                        <span>Registrados</span>
                </a>
                <a href="/admin/settings" class="nav-item <?php if ($selected == 'settings') { echo 'active'; } ?>">
                        <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                        <span>Ajustes</span>
                </a>
        </nav>

        <!-- User profile section -->
        <div class="user-profile">
                <!-- <div class="user-avatar" id="userAvatar"><img src="<?php echo Auth::user()->url_picture; ?>"></div> -->
                <div class="user-info">
                        <span class="user-email" id="userEmail"><?php echo Auth::user()->email; ?></span>
                        <a href="/logout" class="logout">Salir</a>
                </div>
        </div>
</aside>
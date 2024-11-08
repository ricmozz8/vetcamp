<!DOCTYPE html>
<html lang="en">
    <?php
    require_once __DIR__ . '/partials/header.php';
    ?>
    <body>
    <!--- Define your structure here --->
    <div class="back-dash">

      <!-- Sidebar navigation -->
        <aside class="sidebar">
            <!-- Logo section -->
            <div class="logo-container">
                <img src="/placeholder.svg" alt="UPR Arecibo" class="logo">
            </div>

            <!-- Main navigation menu -->
            <nav class="nav-links">
                <a href="/backdashboard" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m3 9 9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    <span>Inicio</span>
                </a>
                <a href="/backapplications" class="nav-item active">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z"/><polyline points="14 2 14 8 20 8"/><line x1="16" x2="8" y1="13" y2="13"/><line x1="16" x2="8" y1="17" y2="17"/><line x1="10" x2="8" y1="9" y2="9"/></svg>
                    <span>Solicitudes</span>
                </a>
                <a href="/backregistered" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    <span>Registrados</span>
                </a>
                <a href="/backsettings" class="nav-item">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74v-.5a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    <span>Ajustes</span>
                </a>
            </nav>

            <!-- User profile section -->
            <div class="user-profile">
                <div class="user-avatar">U</div>
                <div class="user-info">
                    <span class="user-email">usuario@correo.com</span>
                    <a href="#" class="logout">Salir</a>
                </div>
            </div>
        </aside>

     <!-- Main content area -->
     <main class="main-content">
     <!-- Secondary logo container -->
            <div class="logo-container">
                <img src="/placeholder.svg" alt="Vetcamp" class="logo logo-right">
            </div>
        <header class="header">
            <h1 class="welcome"> Solicitudes </h1>
            <button>
        </header>

        <!-- Table header area -->

     </main>
    </div>

    <!-- Footer with copyright information -->
    <footer>
     <p>&copy; <?php echo date('Y'); ?> | Universidad de Puerto Rico Arecibo</p>
     <img class="university-logo" src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra">
    </footer>
    </body>
</html>
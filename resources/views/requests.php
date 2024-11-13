<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>
<body>
    <!--- Define your structure here --->
    <div class="back-dash">

        <!-- Sidebar navigation -->
        <aside class="sidebar">
            <!-- Logo section -->
            <div class="logo-container">
                <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
            </div>

            <!-- Main navigation menu -->
            <nav class="nav-links">
                <a href="/admin" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                    <span>Inicio</span>
                </a>
                <a href="requests" class="nav-item active">
                    <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                    <span>Solicitudes</span>
                </a>
                <a href="registered" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                    <span>Registrados</span>
                </a>
                <a href="settings" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                    <span>Ajustes</span>
                </a>
            </nav>

            <!-- User profile section -->
            <div class="user-profile">
                <div class="user-avatar" id="userAvatar">U</div>
                <div class="user-info">
                    <span class="user-email" id="userEmail">usuario@correo.com</span>
                    <a href="#" class="logout">Salir</a>
                </div>
            </div>
        </aside>

        <!-- Main content area -->
        <main class="main-content">
        <!-- Secondary logo container -->
            <div class="logo-container">
                <img src="/resources/assets/logo/PNG/vetcamp_full_hoz_b.png" alt="Vetcamp" class="logo logo-right">
            </div>
        <header class="header">
            <h1 class="welcome"> Ajustes </h1>
        </header>

    <!-- Table header area -->
    <table>
    <thead>
        <tr>
            <th>Name</th>
            <th class="email-col">Email</th>
            <th>Status</th>
            <th class="date-col">Created At</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Loop through the users returned by the User::all() method
        foreach ($users as $user) {
            // Get the full name
            $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
            echo "<tr>";
            echo "<td>" . $full_name . "</td>";
            echo "<td>" . htmlspecialchars($user->email) . "</td>";
            echo "<td>" . htmlspecialchars($user->status) . "</td>";
            echo "<td>" . htmlspecialchars($user->created_at) . "</td>";
            echo "</tr>";
        }
        ?>
    </tbody>
    </table>

    </main>
    </div>

    <!-- Footer with copyright information -->
    <footer>
    <p>&copy; <?php echo date('Y'); ?> | Universidad de Puerto Rico Arecibo</p>
    <img class="university-logo" src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra">
    </footer>
    </body>
</html>
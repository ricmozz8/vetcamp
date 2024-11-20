<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>
<head>
    <style>

    </style>
</head>

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

            <div class="all_sol">
                <div class="header">
                    <div class="welcome">Solicitudes</div>
                    <div class="search-container">
                        <input type="text" class="search-input" placeholder="Busca correos, nombres, fechas">
                        <span class="search-icon"><img src="https://img.icons8.com/?size=100&id=84039&format=png&color=000000" class="main-icons"></span>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>Perfil</th>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Documentos</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Loop through the users returned by the User::all() method
                            foreach ($users as $user) {
                                // Get the full name
                                $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                                echo "<tr>";
                                echo "<td><img src='$user->application->profile_pic' alt='Profile Picture' style='width: 100px; height: 100px; border-radius: 50%; object-fit: cover;'></td>";
                                echo "<td>" . $full_name . "</td>";
                                echo "<td>" . htmlspecialchars($user->email) . "</td>";
                                echo "<td>" . htmlspecialchars($user->application()->documentCount()) . "/6</td>";
                                echo "<td>" . htmlspecialchars($user->status) . "</td>";
                                echo "<td>" . htmlspecialchars($user->created_at) . "</td>";
                                echo "<td>" . '<a href="#">revisar</a>' . "</td>";          //To add "revisar" link
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <a href="#" class="page-number">1</a>
                    <a href="#" class="page-number">2</a>
                    <a href="#" class="page-number">3</a>
                    <a href="#" class="page-number">4</a>
                </div>
            </div>

        </main>
        </div>

        <!-- Footer with copyright information -->
        <?php require_once('partials/footer.php'); ?>

    </body>
</html>
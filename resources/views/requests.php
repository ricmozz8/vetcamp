<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>


<body>
    <!--- Define your structure here --->
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <!-- Main content area -->
        <main class="main-content">
        <!-- Secondary logo container -->
            

            <div class="listed-table">
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

                           // Set locale to Spanish
                            
                            // Loop through the users returned by the User::all() method
                            foreach ($users as $user) {
                                // Get the full name
                                setlocale(LC_TIME, 'es_ES.UTF-8');
                                $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                                $date = new DateTime($user->created_at);
                                
                                echo "<tr>";
                                echo "<td><img class='profile-picture' src=" . htmlspecialchars($user->application()->url_picture) . " alt='Profile Picture'></td>";
                                echo "<td>" . $full_name . "</td>";
                                echo "<td>" . htmlspecialchars($user->email) . "</td>";
                                echo "<td>" . htmlspecialchars($user->application()->documentCount()) . "/6</td>";
                                echo "<td>" . htmlspecialchars($user->status) . "</td>";
                                echo "<td>" . htmlspecialchars($date->format('d-m-Y')) . "</td>";
                                echo "<td>" . '<a class="main-action-bright no-deco-action" href="requests/r?id=' . $user->user_id . '" class="review-link">revisar</a>' . "</td>";          //To add "revisar" link
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
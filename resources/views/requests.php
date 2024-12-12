<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>


<body>
    <!--- Define your structure here --->
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <a onclick="openModal('sidebar')" href="#" class="openSidebar">
            <i class="las la-bars">
            </i>
        </a>

        <!-- Main content area -->
        <main class="main-content">
            <!-- Secondary logo container -->


            <div class="listed-table">
                <div class="header">
                    <div class="flex-min">
                        <h2 class="welcome">Solicitudes</h2>
                        <a class="main-action-bright secondary" href="#">
                            <i class="las la-file-csv"></i>
                            Importar
                        </a>
                    </div>
                    <div class="table-actions">
                        <button class="main-action-bright tertiary">
                            <i class="las la-filter"></i>
                            Filtrar
                        </button>
                        <div class="search-container">
                            <form method="POST" action="/admin/requests">
                                <input type="text" class="search-input" name="search" placeholder="Busca correos, nombres">
                                
                            </form>
                            <button type="submit " class=" no-deco-action"> <i class="las la-search"></i> </button>
                        </div>
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



                            echo "<tr>";
                            echo "<td><img class='profile-picture' src=" . htmlspecialchars($user->application()->url_picture) . " alt='Profile Picture'></td>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($user->email) . "</td>";
                            echo "<td>" . (htmlspecialchars($user->application() ? $user->application()->documentCount() : 0)) . "/6</td>";
                            echo "<td>" . htmlspecialchars($user->status) . "</td>";
                            echo "<td>" . htmlspecialchars(get_date_spanish($user->created_at)) . "</td>";
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
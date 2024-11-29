<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
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
                    <h2 class="welcome">Registrados</h2>
                    <div class="table-actions">
                        <button class="main-action-bright tertiary">
                            <i class="las la-filter"></i>
                            Filtrar
                        </button>
                        <div class="search-container">
                            <input type="text" class="search-input" placeholder="Busca correos, nombres, fechas">
                            <a href="#">
                                <i class="las la-search"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>

                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Estado</th>
                            <th>Fecha</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the users returned by the User::all() method
                        foreach ($users as $user) {
                            // Get the full name
                            $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                            $date = new DateTime($user->created_at);
                            echo "<tr>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($user->email) . "</td>";
                            echo "<td>" . htmlspecialchars($user->status) . "</td>";
                            echo "<td>" . htmlspecialchars($date->format('d-m-Y')) . "</td>";
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
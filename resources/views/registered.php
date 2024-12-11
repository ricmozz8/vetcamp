<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';

$statusParsing = [
    'active' => 'Activo',
    'disabled' => 'Desactivado'
]
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
                            <form method="POST" action="/admin/registered">
                                <input type="text" class="search-input" name="search" placeholder="Busca correos, nombres">
                                <button type="submit"> <i class="las la-search"></i> </button>
                            </form>
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
                            <th></th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Loop through the users returned by the User::all() method
                        foreach ($users as $user) {
                            // Get the full name
                            $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                            $status = htmlspecialchars($user->status);
                            $statusColor = $status === 'active' ? '#11df11' : '#df1111';

                            if (isset($statusParsing[$status])) {
                                $status = $statusParsing[$status];
                            }



                            echo "<tr>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($user->email) . "</td>";
                            echo "<td class='status-badge'>" . '<i class="las la-dot-circle" style="color: ' . $statusColor . '" > </i>'  . htmlspecialchars($status) . "</td>";
                            echo "<td>" . htmlspecialchars(get_date_spanish($user->created_at)) . "</td>";
                            echo '<td>' . '<a id="manage-user-button" href="#" onclick="openContextMenu(event, \'manage-user\')" class="w-fit main-action-bright quaternary-squared">' . '<i class="las la-ellipsis-v"></i>' . '</a>' . '</td>';
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <div class="pagination">
                    <?php if ($currentPage > 1): ?>
                        <a href="?page=<?php echo $currentPage - 1; ?>" class="page-number">Anterior</a>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPages, $currentPage + 2);

                    if ($start > 1) {
                        echo '<a href="?page=1" class="page-number">1</a>';
                        if ($start > 2) {
                            echo '<span class="page-ellipsis">...</span>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++):
                    ?>
                        <a href="?page=<?php echo $i; ?>" class="page-number <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                            <?php echo $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php
                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<span class="page-ellipsis">...</span>';
                        }
                        echo '<a href="?page=' . $totalPages . '" class="page-number">' . $totalPages . '</a>';
                    }
                    ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="?page=<?php echo $currentPage + 1; ?>" class="page-number">Siguiente</a>
                    <?php endif; ?>
                </div>

                <div id="manage-user" class="context-menu manage-user">
                    <a href="#">
                        <i class="las la-times"></i>
                        Desactivar
                    </a>
                    <a href="#">
                        <i class="las la-trash"></i>
                        Eliminar
                    </a>
                    <a href="#">
                        <i class="las la-lock"></i>
                        Restablecer Contraseña
                    </a>
                </div>
            </div>

        </main>

        <script>
            // close context menu if the user clicks outside of it
            document.addEventListener('click', function(event) {
                // check if the user pressed the manage-user-button
                if (event.target.closest('#manage-user-button') === null) {
                    if (event.target.closest('.manage-user') === null) {
                        closeContextMenu('manage-user');
                    }
                }
            });
        </script>
    </div>

    <!-- Footer with copyright information -->
    <?php require_once('partials/footer.php'); ?>

</body>

</html>
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
<?php require_once('partials/profileNav.php'); ?>
<div class="back-dash">

    <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>
    <a onclick="openModal('sidebar')" href="#" class="openSidebar">
        <i class="fas fa-bars">
        </i>
    </a>

    <!-- Main content area -->
    <main class="main-content">
        <!-- Secondary logo container -->


        <div class="listed-table">
            <div class="header">
                <h2 class="welcome">Usuarios</h2>
                <div class="table-actions">
                    <button class="main-action-bright tertiary" onclick="openModal('filterModal')">
                        <i class="fas fa-filter"></i>
                        Filtrar
                    </button>
                    <div class="search-container">
                        <form method="POST" action="/admin/registered">
                            <input required value="<?= isset($_POST['search']) ? $_POST['search'] : '' ?>" type="text"
                                   class="search-input" name="search" placeholder="Busca correos, nombres">
                            <?php if (isset($_POST['search'])): ?>
                                <a class="no-deco-action" href="/admin/registered"><i class="fas fa-times"></i></a>
                            <?php endif; ?>
                            <button type="submit" class="main-action-bright tertiary"><i class="fas fa-search"></i>
                            </button>
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
                    <!-- <th></th> -->
                    <th></th>

                </tr>
                </thead>
                <tbody>
                <?php
                // Loop through the users returned by the User::all() method
                $loop = 1;
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
                    echo "<td class='status-badge'>" . '<i class="fas fa-dot-circle" style="color: ' . $statusColor . '" > </i>' . htmlspecialchars($status) . "</td>";
                    echo "<td>" . htmlspecialchars(get_date_spanish($user->created_at)) . "</td>";
                    // echo '<td>' . '<a id="manage-user-button" href="#" onclick="openContextMenu(event, \'manage-user\')" class="w-fit main-action-bright quaternary-squared">' . '<i class="fas fa-ellipsis-v"></i>' . '</a>' . '</td>';
                    echo '<td><a class="main-action-bright no-deco-action" href="/admin/registered/r?id=' . $user->user_id . '&action=active" class="review-link">Activar</a></td>';
                    echo '<td><a class="main-action-bright no-deco-action" href="/admin/registered/r?id=' . $user->user_id . '&action=disabled" class="review-link">Desactivar</a></td>';
                    echo '<td>' . '<a onclick="openModal(\'confirmDeleteUserModal-' . $loop++ . '\')" class="main-action-bright no-deco-action" href="#' . '" class="review-link"> <i class="fas fa-trash"></i> borrar</a>' . "</td>";
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
                    <a href="?page=<?php echo $i; ?>"
                       class="page-number <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
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

            <!-- <div id="manage-user" class="context-menu manage-user">
                <a href="#">
                    <i class="fas fa-times"></i>
                    Desactivar
                </a>
                <a class="nav-danger" href="#">
                    <i class="fas fa-trash"></i>
                    Eliminar
                </a>
                <a href="#">
                    <i class="fas fa-lock"></i>
                    Restablecer Contraseña
                </a>
            </div> -->
        </div>

    </main>

    <!-- modals -->
    <section>
        <?php
        // Loop through the users returned by the User::all() method
        $loop = 1;
        foreach ($users as $user) {
            $user_id = $user->user_id;
            require __DIR__ . '/modals/confirmDeleteUserModal.php';
            $loop++;
        }

        ?>

    </section>

    <?php require __DIR__ . '/modals/filterUsersModal.php'; ?>

    <script>
        // close context menu if the user clicks outside of it
        document.addEventListener('click', function (event) {
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
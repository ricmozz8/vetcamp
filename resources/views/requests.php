<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>


<body>
<!--- Define your structure here --->
<?php require_once('partials/profileNav.php'); ?>
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

                </div>
                <div class="table-actions">
                    <button onclick="openModal('filterModalRequest')" class="main-action-bright tertiary">
                        <i class="las la-filter"></i>
                        Filtrar
                    </button>
                    <div class="search-container">
                        <form method="POST" action="/admin/requests">
                            <input required value="<?= $_POST['search'] ?? '' ?>" type="text"
                                   class="search-input" name="search" placeholder="Busca correos, nombres">
                            <?php if (isset($_POST['search'])): ?>
                                <a class="no-deco-action" href="/admin/requests"><i class="las la-times"></i></a>
                            <?php endif; ?>
                            <button type="submit" class="main-action-bright tertiary"><i class="las la-search"></i>
                            </button>
                        </form>

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
                    <th></th>
                </tr>
                </thead>
                <tbody>

                <?php
                /*
                 * TODO: Gotta refactor this, rendering html by echoing it on php is a bad practice. Imperative if we want to include the filters on the table headers.
                 *
                 * */

                // Set locale to Spanish

                // Loop through the users returned by the User::all() method
                foreach ($users as $user) {
                    // Get the full name
                    setlocale(LC_TIME, 'es_ES.UTF-8');
                    $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                    $pictureObj = $user->application()->getProfilePicture();
                    $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

                    $application = $user->application();


                    echo "<tr>";
                    echo "<td><a href='requests/r?id=$user->user_id'><img src=\"$src\" alt=\"Image\" class=\"profile-picture\"></a> </td>";
                    echo "<td>" . $full_name . "</td>";
                    echo "<td>" . htmlspecialchars($user->email) . "</td>";
                    echo "<td>" . (htmlspecialchars($application ? $application->documentCount() : 0)) . "/7</td>";
                    echo "<td>" . "<p class=\"st-badge status-badge-alt-" . str_replace(' ', '-', strtolower($application->status)) . "\">" . $application->status . "</p>" . "</td>";
                    echo "<td>" . htmlspecialchars(get_date_spanish($user->created_at)) . "</td>";
                    echo "<td>" . '<a class="main-action-bright no-deco-action" href="requests/r?id=' . $user->user_id . '" class="review-link">revisar</a>' . "</td>";
                    echo "<td>" . '<a class="main-action-bright no-deco-action" href="#" onclick="">' . '<i class="las la-trash"></i> borrar' . '</a>' . '<td/>';
                    echo "</tr>";
                }
                ?>
                </tbody>
            </table>
            <div class="pagination">
                <?php if ($currentPage > 1): ?>
                    <a href="?page=<?php echo $currentPage - 1; ?>&estado=<?php echo isset($_GET['estado']) ? $_GET['estado'] : '-1'; ?>" class="page-number">Anterior</a>
                <?php endif; ?>

                <?php
                $start = max(1, $currentPage - 2);
                $end = min($totalPages, $currentPage + 2);

                if ($start > 1) {
                    echo '<a href="?page=1&estado=' . (isset($_GET['estado']) ? $_GET['estado'] : '-1') . '" class="page-number">1</a>';
                if ($start > 2) {
                    echo '<span class="page-ellipsis">...</span>';
                }
                }

            for ($i = $start; $i <= $end; $i++):
            ?>
                <a href="?page=<?php echo $i; ?>&estado=<?php echo isset($_GET['estado']) ? $_GET['estado'] : '-1'; ?>"
                    class="page-number <?php echo ($i == $currentPage) ? 'active' : ''; ?>">
                <?php echo $i; ?>
                </a>
            <?php endfor; ?>

        <?php
            if ($end < $totalPages) {
                if ($end < $totalPages - 1) {
                    echo '<span class="page-ellipsis">...</span>';
                }
                echo '<a href="?page=' . $totalPages . '&estado=' . (isset($_GET['estado']) ? $_GET['estado'] : '-1') . '" class="page-number">' . $totalPages . '</a>';
            }
        ?>

    <?php if ($currentPage < $totalPages): ?>
        <a href="?page=<?php echo $currentPage + 1; ?>&estado=<?php echo isset($_GET['estado']) ? $_GET['estado'] : '-1'; ?>" class="page-number">Siguiente</a>
    <?php endif; ?>
</div>

        </div>

    </main>
</div>
<?php require __DIR__ . '/modals/filterModalRequest.php'; ?>

<!-- Footer with copyright information -->
<?php require_once('partials/footer.php'); ?>

</body>

</html>
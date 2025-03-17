<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/partials/header.php';
require_once __DIR__ . '/modals/confirmDownloadApplicationsModal.php';
?>


<body>
    <!--- Define your structure here --->
    <?php require_once('partials/profileNav.php'); ?>
    <div class="back-dash">
        <script src="<?= web_resource('js/posterTable.js') ?>"></script>

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
                    <div class="flex-min">
                        <h2 class="welcome">Solicitudes</h2>
                    </div>
                    <div class="table-actions">
                    <button class="main-action-bright tertiary"  style="background-color: green;" onclick="openModal('confirmDownloadApplicationsModal')">
                            <i class="fas fa-file-excel"></i>
                            Exportar
                        </button>
                        <?php if (isset($_GET['s']) || isset($_GET['doc']) || isset($_GET['date'])) { ?>
                            <a href="/admin/requests" class="main-action-bright">
                                <i class="fa-solid fa-filter-circle-xmark"></i>
                                Eliminar filtros
                            </a>
                        <?php } ?>
                        <button onclick="openModal('filterModalRequest')" class="main-action-bright tertiary">
                            <i class="fas fa-filter"></i>
                            Filtrar
                        </button>
                        <div class="search-container">
                            <form method="GET" action="/admin/requests">
                                <input required value="<?= $_GET['search'] ?? '' ?>" type="text"
                                    class="search-input" name="search" placeholder="Busca correos, nombres">
                                <?php if (isset($_GET['search'])): ?>
                                    <a class="no-deco-action" href="/admin/registered"><i class="fas fa-times"></i></a>
                                <?php endif; ?>
                                <button type="submit" class="main-action-bright tertiary"><i class="fas fa-search"></i>
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
                <div class="">
                    <div class="stat-number">
                        <table>
                            <thead>
                                <tr>
                                    <th>Perfil</th>
                                    <th>Nombre</th>
                                    <th>Correo</th>
                                    <th class="actionable-header" id="order-doc">
                                        <?php
                                        $queryParams = $_GET;
                                        $queryParams['doc'] = isset($queryParams['doc']) && $queryParams['doc'] === 'asc' ? 'desc' : 'asc';
                                        $queryString = http_build_query($queryParams);
                                        ?>
                                        <a href="?<?= $queryString ?>"><strong>Documentos</strong> <?= isset($_GET['doc']) && $_GET['doc'] === 'asc' ? '↓' : '↑' ?></a>
                                    </th>


                                    <th style="cursor: pointer" onclick="openModal('filterModalRequest')">Estado</th>
                                    <th class="actionable-header" id="order-date">
                                        <?php
                                        $queryParams = $_GET;
                                        $queryParams['order'] = $order === 'asc' ? 'desc' : 'asc';
                                        $queryString = http_build_query($queryParams);
                                        ?>
                                        <a href="?<?= $queryString ?>"><strong>Fecha</strong><?= $order === 'asc' ? '↓' : '↑' ?></a>

                                    </th>


                                    <th>Acción</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $loop = 1;
                                foreach ($users as $application):

                                    $full_name = htmlspecialchars($application->first_name . ' ' . $application->last_name);

                                    $pictureObj = $application->getProfilePicture();
                                    $src = '';
                                    if ($pictureObj)
                                        $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

                                ?>
                                    <tr>
                                        <td>

                                            <a href="/admin/p?user=<?= $application->user_id ?>&from=requests">
                                                <?php if ($pictureObj): ?>
                                                    <img src="<?= $src ?>"
                                                        alt="Image"
                                                        class="profile-picture">
                                                <?php else: ?>
                                                    <?php $badgeUser = $application;
                                                    require __DIR__ . '/partials/userBadge.php'

                                                    ?>
                                                <?php endif; ?>

                                            </a>


                                        </td>
                                        <td><?= $full_name ?></td>
                                        <td class="selectable"><?= htmlspecialchars($application->email) ?></td>
                                        <td><?= htmlspecialchars($application ? $application->documentCount() : 0) ?>/7</td>
                                        <td>
                                            <p class="st-badge status-badge-alt-<?= str_replace(' ', '-', strtolower($application->status)) ?>"><?= $application->status ?></p>
                                        </td>
                                        <td><?= htmlspecialchars(get_date_spanish($application->created_at)) ?></td>
                                        <td><a
                                                href="requests/r?id=<?= $application->user_id ?>"
                                                class="review-link"><i class="fas fa-eye"></i>revisar</a></td>
                                        <td>
                                            <a class="review-link danger" href="#"
                                                onclick="openModal('confirmDeleteApplicationModal-<?= $loop ?>')">
                                                <i class="fas fa-trash"></i> borrar
                                            </a>
                                        </td>
                                    </tr>
                                    <?php $loop++; ?>
                                <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pagination">
                    <?php
                    // Construir la base de la URL con los filtros actuales
                    $queryParams = $_GET;
                    unset($queryParams['page']); // Quitamos 'page' para reemplazarlo con el correcto
                    $queryString = http_build_query($queryParams);
                    $baseUrl = "?$queryString"; // Base con los filtros actuales
                    ?>

                    <?php if ($currentPage > 1): ?>
                        <a href="<?= $baseUrl . '&page=' . ($currentPage - 1) ?>" class="page-number">Anterior</a>
                    <?php endif; ?>

                    <?php
                    $start = max(1, $currentPage - 2);
                    $end = min($totalPages, $currentPage + 2);

                    if ($start > 1) {
                        echo '<a href="' . $baseUrl . '&page=1" class="page-number">1</a>';
                        if ($start > 2) {
                            echo '<span class="page-ellipsis">...</span>';
                        }
                    }

                    for ($i = $start; $i <= $end; $i++):
                    ?>
                        <a href="<?= $baseUrl . '&page=' . $i ?>"
                            class="page-number <?= ($i == $currentPage) ? 'active' : ''; ?>">
                            <?= $i; ?>
                        </a>
                    <?php endfor; ?>

                    <?php
                    if ($end < $totalPages) {
                        if ($end < $totalPages - 1) {
                            echo '<span class="page-ellipsis">...</span>';
                        }
                        echo '<a href="' . $baseUrl . '&page=' . $totalPages . '" class="page-number">' . $totalPages . '</a>';
                    }
                    ?>

                    <?php if ($currentPage < $totalPages): ?>
                        <a href="<?= $baseUrl . '&page=' . ($currentPage + 1) ?>" class="page-number">Siguiente</a>
                    <?php endif; ?>
                </div>

            </div>

            <?php
            $loop = 1;
            foreach ($users as $user): ?>
                <?php require __DIR__ . "/modals/confirmDeleteApplicationModal.php";

                $loop++;
                ?>
            <?php endforeach; ?>

        </main>
    </div>
    <?php require __DIR__ . '/modals/filterModalRequest.php'; ?>

    <!-- Footer with copyright information -->
    <?php require_once('partials/footer.php'); ?>

</body>

</html>
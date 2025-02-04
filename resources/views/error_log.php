<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


?>

<body>
    <div class="back-dash">
        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <!-- Main content area -->
        <div class="main-content">
            <div class="stat-card">
                <div class="stat-header">
                    <h2 class="stat-title">
                        <i class="las la-bug"></i>
                        Errores de la aplicación
                    </h2>
                </div>
                <div class="stat-number">
                    <table class="error-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Error</th>
                                <th>Archivos</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($errors as $error) : ?>
                                <tr>
                                    <td><?= $error->throwed ?></td>
                                    <td><?= $error->error ?></td>
                                    <td><?= $error->file_trace ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
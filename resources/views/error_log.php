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
                    <textarea name="errorlog" id="log-ta" class="log-ta"><?= $errors ?></textarea>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
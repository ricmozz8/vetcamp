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
                        Error log
                    </h2>
                    <a target="_blank" class="main-action-bright tertiary" href="/admin/dev/errors/download">
                        <i class="las la-download"></i>
                        Download
                    </a>
                </div>
                <div class="stat-number">
                    <textarea name="errorlog" id="log-ta" class="log-ta"><?= $errors ?></textarea>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
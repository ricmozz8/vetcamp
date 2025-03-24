<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>

    <?php require_once('partials/profileNav.php'); ?>

    <div class="back-dash">
        <main class="main-content">


            <div class="listed-table">
                <div class="header flex-sb">

                    <div class="flex-min">
                        <h2 class="welcome">Registro de auditoría</h2>
                    </div>

                    <div class="flex-min">
                        <a href="/admin/audit/download" class="main-action-bright"> <i class="fas fa-download"></i>Descargar</a>
                    </div>

                </div>

                <div class="audit-grid">
                    <?php foreach ($audits as $audit): ?>
                        <div class="audit-card-<?= $audit->action ?>">

                            <div class="card-details">
                                <div class="card-header">
                                    <?php
                                    $badgeUser = $audit;
                                    require __DIR__ . '/partials/userBadge.php'; ?>
                                    <a class="underline-action" href="/admin/p?user=<?= $badgeUser->user_id ?>"><h1 ><?= $badgeUser->first_name . ' ' . $badgeUser->last_name ?></h1></a>
                                    <?php if (Auth::user()->user_id === $badgeUser->user_id): ?>
                                        <p class="mini-badge primary">Tú</p>
                                    <?php endif; ?>
                                </div>

                                <div class="card-timestamps">
                                <p class="timestamp"><?= $audit->made_on ?></p>
                                    <div class="action-icon">
                                        <?php if ($audit->action == 'create'): ?>
                                            <i class="fas fa-user-plus"></i>
                                        <?php elseif ($audit->action == 'delete'): ?>
                                            <i class="fas fa-user-minus"></i>
                                        <?php elseif ($audit->action == 'update'): ?>
                                            <i class="fas fa-user-edit"></i>
                                        <?php endif; ?>
                                    </div>
                                    
                                </div>
                            </div>
                            <div class="card-body">
                                <p><?= $audit->summary ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

            </div>
    </div>
    </main>
    </div>
</body>


<?php require_once('partials/footer.php'); ?>

</html>
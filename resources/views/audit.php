<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


$testAuditInfo = [
    [
        'user_id' => 1,
        'action' => 'create',
        'summary' => 'Created a new administrator user with email "0Ttj3@example.com".',
        'created_at' => '2023-10-01 10:00:00'
    ],
    [
        'user_id' => 2,
        'action' => 'delete',
        'summary' => 'Removed the user with ID 123.',
        'created_at' => '2023-10-02 11:30:00'
    ],
    [
        'user_id' => 3,
        'action' => 'update',
        'summary' => 'Changed the application status to "Approved" of the user with ID 456.',
        'created_at' => '2023-10-03 14:45:00'
    ]
];



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
                        <a href="/admin/audit/download" class="main-action-bright"> <i class="fas fa-download"></i></a>
                    </div>

                </div>

                <div class="audit-grid">
                    <?php foreach ($audits as $audit): ?>
                        <div class="audit-card-<?= $audit->action ?>">

                            <div class="card-details">
                                <div class="card-header">
                                    <?php
                                    $badgeUser = $audit->user(); // test only
                                    require __DIR__ . '/partials/userBadge.php'; ?>
                                    <a class="underline-action" href="/admin/p?user=<?= $badgeUser->user_id ?>"><h1 ><?= $badgeUser->full_name() ?></h1></a>
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
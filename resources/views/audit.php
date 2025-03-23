<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


$testAuditInfo = [
    [
        'user_id' => 1,
        'action' => 'edit',
        'field_name' => 'email',
        'previous_value' => 'old@example.com',
        'current_value' => 'new@example.com',
        'created_at' => '2023-10-01 10:00:00'
    ],
    [
        'user_id' => 2,
        'action' => 'delete',
        'field_name' => 'user',
        'previous_value' => 'John Doe',
        'current_value' => 'N/A',
        'created_at' => '2023-10-02 11:30:00'
    ],
    [
        'user_id' => 3,
        'action' => 'update',
        'field_name' => 'role',
        'previous_value' => 'user',
        'current_value' => 'admin',
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
                        <a class="main-action-bright secondary"> <i class="fas fa-filter"></i> Filtros</a>
                        <a class="main-action-bright"> <i class="fas fa-download"></i> Descargar</a>
                    </div>

                </div>

                    <table>
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Usuario</th>
                                <th>Accion</th>
                                <th>Campo</th>
                                <th>Valor anterior</th>
                                <th>Valor nuevo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($testAuditInfo as $audit) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($audit['created_at']) . '</td>';
                                echo '<td>' . htmlspecialchars($audit['user_id']) . '</td>';
                                echo '<td>' . htmlspecialchars($audit['action']) . '</td>';
                                echo '<td>' . htmlspecialchars($audit['field_name']) . '</td>';
                                echo '<td>' . htmlspecialchars($audit['previous_value']) . '</td>';
                                echo '<td>' . htmlspecialchars($audit['current_value']) . '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
            </div>
    </div>
    </main>
    </div>
</body>


<?php require_once('partials/footer.php'); ?>

</html>
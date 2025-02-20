<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


$isAdmin = Auth::user()->type === 'admin';
?>
<body>
<!--- Define your structure here --->
<?php require 'partials/profileNav.php'; ?>


<div class="big-profile">
    <div class="big-actions">

        <?php
        if ($isAdmin || !Auth::user()->application()) {
            $badgeUser = Auth::user();
            require 'partials/userBadge.php';
        } else { // the user has profile picture
            $profile = Auth::user()->application()->getProfilePicture();
            $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
            ?>
            <img src="<?= $src ?>" alt="profile-picture">
        <?php } ?>
        <div class="profile-user">

            <div class="flex-min">
                <h1><?= Auth::user()->full_name() ?></h1>
                <a onclick="openModal('userProfileEditModal')" href="#" class="semi-rounded-action"><i
                            class="fas fa-pencil"></i></a>
            </div>


            <p><?= Auth::user()->email ?></p>


            <?php if ($isAdmin) { ?>
                <p>Última vez conectado: <?= get_date_spanish(Auth::user()->last_login) ?></p>
                <p class="badge">
                    <span class="badge">Admin</span>
                </p>

            <?php } ?>
        </div>
    </div>


</div>

<div class="user-manage-section">

    <?php if (!$isAdmin) { ?>
        <div class="user-data-grid">

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección Postal</h2>
                    <span class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
                </div>
                <?php if (Auth::user()->postal_address()) { ?>
                    <p class="composed-address"><?= Auth::user()->postal_address()->build() ?></p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección Física</h2>
                    <span class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
                </div>
                <?php if (Auth::user()->physical_address()) { ?>
                    <p class="composed-address"><?= Auth::user()->physical_address()->build() ?></p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección de la escuela</h2>
                    <span class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
                </div>
                <?php if (Auth::user()->school_address()) { ?>
                    <p class="composed-address"><?= Auth::user()->school_address()->build() ?></p>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    <div class="profile-action-group">
        <div class="profile-header">
            <i class="fas fa-user"></i>
            <h1>Manejar cuenta</h1>
        </div>


        <div class="section-divider">
            <h4 class="flex-min"><i class="fas fa-lock"></i>Manejar inicio de sesión</h4>
        </div>

        <form class="simple-form" action="/profile/password/change" method="post">
            <h2>Cambiar contraseña</h2>
            <div class="form-group">
                <label for="current-password">Contraseña actual</label>
                <input required type="password" name="current-password" id="current-password"
                       placeholder="Contraseña Actual">
            </div>
            <div class="form-group">
                <label for="new-password">Crea una contraseña (Mínimo 8 caracteres)</label>
                <input required pattern=".{8,}" type="password" name="new-password" id="new-password"
                       placeholder="Nueva contraseña">
            </div>
            <div class="form-group">
                <label for="confirm-new-password">Crea una contraseña</label>
                <input required pattern=".{8,}" type="password" name="confirm-new-password" id="confirm-new-password"
                       placeholder="Confirma la nueva contraseña">
            </div>

            <div class="form-actions">
                <button class="main-action-bright primary" type="submit">Actualizar</button>
            </div>

        </form>

        <span class="danger-section">
            <h4 class="flex-min"><i class="fas fa-circle-exclamation"></i>Cambios irreversibles</h4>
            <p>Tenga cuidado al accionar las opciones a continuación, pues pueden causar la eliminación de datos de forma irreversible.</p>
        </span>

        <div class="danger-actions-group">
            <div class="setting-flex-action">
                <h3>Eliminar cuenta</h3>
                <a onclick="openModal('confirmDeleteAccountModal')" href="#" class="main-action-bright danger"><i
                            class="fas fa-trash"></i>Eliminar</a>
            </div>
            <?php if (!$isAdmin && Auth::user()->application()) { ?>
                <div class="setting-flex-action">
                    <h3>Eliminar solicitud</h3>
                    <a href="#" class="main-action-bright danger"><i class="fas fa-trash"></i>Eliminar</a>
                </div>
            <?php } ?>
        </div>
    </div>

</div>

<?php
require 'partials/footer.php';
include(__DIR__ . '/modals/userProfileEditModal.php');
require __DIR__ . '/modals/confirmDeleteAccountModal.php';
?>

</body>
</html>
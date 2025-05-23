<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


$isAdmin = Auth::user()->type === 'admin';

if (!$isAdmin) {
    $application = Auth::user()->application();
    $hasPhoto = $application !== null && $application->url_picture !== null;
}
?>
<body>
<!--- Define your structure here --->
<?php require 'partials/profileNav.php'; ?>


<div class="big-profile">
    <div class="big-actions">

        <?php
        if ($isAdmin || !$hasPhoto) {
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

            <?php } else { ?>
                <div class="flex-min">
                    <p class="flex-min"><i class="fas fa-phone"></i> +1 <?= format_phone(Auth::user()->phone_number) ?>
                    </p>
                    <a onclick="openModal('phoneNumberEditModal')" href="#" class="semi-rounded-action"><i
                                class="fas fa-pencil"></i></a>
                </div>

            <?php }
            require __DIR__ . '/modals/phoneNumberEditModal.php';
            require __DIR__ . '/modals/postalEditModal.php';
            require __DIR__ . '/modals/physicalEditModal.php';
            require __DIR__ . '/modals/schoolEditModal.php';
            ?>
        </div>
    </div>


</div>

<div class="user-manage-section">

    <?php if (!$isAdmin) { ?>
        <div class="user-data-grid">

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección Postal</h2>
                    <span onclick="openModal('postalEditModal')" class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
                </div>
                <?php if (Auth::user()->postal_address()) { ?>
                    <p class="composed-address"><?= Auth::user()->postal_address()->build() ?></p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección Física</h2>
                    <span onclick="openModal('physicalEditModal')" class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
                </div>
                <?php if (Auth::user()->physical_address()) { ?>
                    <p class="composed-address"><?= Auth::user()->physical_address()->build() ?></p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección de la escuela</h2>
                    <span onclick="openModal('schoolEditModal')" class="semi-rounded-action"><i id="edit-icon" class="fas fa-pencil"></i></span>
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
                <label for="old_password">Contraseña actual <i class="fas fa-eye password-toggle pt-1"
                                                               onclick="togglePassword('old_password', 'pt-1')"></i></label>
                <input required type="password" name="old_password" id="old_password" class="old-password"
                       placeholder="Contraseña Actual">
            </div>
            <div class="form-group">
                <label for="new_password">Crea una contraseña (Mínimo 8 caracteres) <i
                            class="fas fa-eye password-toggle pt-2"
                            onclick="togglePassword('new_password', 'pt-2')"></i></label>
                <input required pattern=".{8,}" type="password" name="new_password" id="new_password"
                       class="new-password"
                       placeholder="Nueva contraseña">
            </div>
            <div class="form-group">
                <label for="confirm_new_password">Confirma la nueva contraseña <i
                            class="fas fa-eye password-toggle pt-3"
                            onclick="togglePassword('confirm_new_password', 'pt-3')"></i></label>
                <input required pattern=".{8,}" type="password" name="confirm_new_password" class="confirm-pass"
                       id="confirm_new_password"
                       placeholder="Confirma la nueva contraseña">
            </div>

            <div class="form-actions">
                <button class="main-action-bright primary" type="submit">Actualizar</button>
            </div>

        </form>

        <span class="danger-section">
            <h4 class="flex-min"><i class="fas fa-circle-exclamation"></i>Cambios irreversibles</h4>
            <p>Tenga cuidado al accionar las opciones a continuación, pues pueden causar la <strong>eliminación de datos de forma irreversible.</strong></p>
        </span>

        <div class="danger-actions-group">
            <div class="setting-flex-action">
                <h3 id="del">Eliminar cuenta</h3>
                <a onclick="openModal('confirmDeleteAccountModal')" href="#" class="main-action-bright danger"><i
                            class="fas fa-trash"></i>Eliminar</a>
            </div>
            <?php if (!$isAdmin && Auth::user()->application()) { ?>
                <div class="setting-flex-action">
                    <h3>Rescindir solicitud</h3>
                    <a onclick="openModal('confirmRemoveApplicationModal')" href="#" class="main-action-bright danger"><i class="fas fa-trash"></i>Eliminar</a>
                </div>
            <?php }
            require __DIR__ . '/modals/confirmRemoveApplicationModal.php';
            ?>
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
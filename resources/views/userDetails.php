<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';


$isAdmin = $user->type === 'admin';

if (!$isAdmin) {
    $application = $user->application();
    $hasPhoto = $application && $application->url_picture;
}
?>
<body>
<!--- Define your structure here --->
<?php require 'partials/profileNav.php'; ?>

<div class="section-header">

    <a href="/admin<?= $from ?? '' ?>" class="main-action-bright"><i class="las la-arrow-left"></i> Volver</a>

    <a onclick="openModal('singleMessageModal')" href="#" class="main-action-bright secondary" ><i class="fas fa-envelope"></i>Enviar mensaje</a>
</div>

<div class="big-profile">


    <div class="big-actions">

        <?php
        if ($isAdmin || !$hasPhoto) {
            $badgeUser = $user;
            require 'partials/userBadge.php';
        } else { // the user has profile picture
            $profile = $user->application()->getProfilePicture();
            $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
            ?>
            <img src="<?= $src ?>" alt="profile-picture">
        <?php } ?>
        <div class="profile-user">

            <div class="flex-min">
                <h1><?= $user->full_name() ?></h1>

            </div>


            <p><?= $user->email ?></p>


            <p>Última vez conectado: <?= get_date_spanish($user->last_login) ?></p>

            <?php if ($isAdmin) { ?>
                <p class="badge">
                    <span class="badge">Admin</span>
                </p>
            <?php } else { ?>


            <div class="flex-min">
                <p class="flex-min"><i class="fas fa-phone"></i> +1 <?= format_phone($user->phone_number ?? '') ?>
                </p>
            </div>
            <?php } ?>

            <br>
            <?php if ($user->application() && $user->application()->status !== 'Sin subir') { ?>
            <a href="/admin/requests/r?id=<?= $user->user_id ?>" class="main-action-bright primary">
                <i class="fas fa-id-badge "></i>
                Ver solicitud (<?= $user->application()->status ?>)
            </a>
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

                </div>
                <?php if ($user->postal_address()) { ?>
                    <p class="composed-address"><?= $user->postal_address()->build() ?></p>
                <?php } else { ?>
                 <p class="no-data-disc">(Sin llenar)</p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección Física</h2>

                </div>
                <?php if ($user->physical_address()) { ?>
                    <p class="composed-address"><?= $user->physical_address()->build() ?></p>
                <?php } else { ?>
                    <p class="no-data-disc">(Sin llenar)</p>
                <?php } ?>
            </div>

            <div class="grid-data-box">
                <div class="grid-data-box-header">

                    <h2>Dirección de la escuela</h2>

                </div>
                <?php if ($user->school_address()) { ?>
                    <p class="composed-address"><?= $user->school_address()->build() ?></p>
                <?php } else { ?>
                <p class="no-data-disc">(Sin llenar)</p>
                <?php } ?>
            </div>
        </div>
    <?php } ?>



    <p class="disclaimer">
        Usuario registrado por primera vez el <?= get_date_spanish($user->created_at) ?>.
    </p>



</div>

<?php
require 'partials/footer.php';
include(__DIR__ . '/modals/singleMessageModal.php');

?>

</body>
</html>
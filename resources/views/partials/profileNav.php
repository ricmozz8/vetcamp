<?php
$user_full_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;

?>

    <div class="auth-navbar-alt">
        <div class="nav-container">
            <?php if (Auth::user()->type == 'admin') : ?>

                <a href="/admin">
                    <img class="app-logotype" src="/<?= asset('logo/SVG/admin_logo_black.svg') ?>" alt="">
                </a>
                <div onclick="toggleDropdown('profile-drop')" class="auth-profile-card" id="drop-profile">
                    <?php $badgeUser = Auth::user();
                    require 'userBadge.php';
                    ?>
                    <div class="auth-profile-card-name"><?= $user_full_name ?></div>
                    <i class="fas fa-caret-down"></i>
                </div>

            <?php else : ?>
                <?php require_once('applicationLogo.php'); ?>
                <div onclick="toggleDropdown('profile-drop')" class="auth-profile-card" id="drop-profile">
                    <?php
                    if (Auth::user()->application()) {
                        $profile = Auth::user()->application()->getProfilePicture();
                        $src = "data:" . $profile['type'] . ";base64," . base64_encode($profile['contents']);
                    } else {
                        $profile = null;
                    }

                    if ($profile) {
                        ?>
                        <img class="user-badge-nav" src="<?= $src ?>" alt="">
                    <?php } else { ?>
                        <?php $badgeUser = Auth::user();
                        require 'userBadge.php';
                    } ?>
                    <div class="auth-profile-card-name"><?= $user_full_name ?></div>
                    <i class="fas fa-caret-down"></i>
                </div>
            <?php endif; ?>
        </div>


    </div>
<?php require_once('profileDropdown.php'); ?>


<?php include(__DIR__ . '../../modals/confirmLogoutModal.php') ?>
<?php include(__DIR__ . '../../modals/userProfileEditModal.php') ?>
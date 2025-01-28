<?php
$user_full_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
?>
<div class="auth-navbar">

        <?php require_once('applicationLogo.php'); ?>
   
    <a href="#" class="main-action-bright primary" onclick="toggleDropdown('profileDropdown')">
        <i class="las la-user"></i>
        <h3 class="no-mobile"><?= $user_full_name ?></h3>
        <i class="las la-caret-down"></i>
    </a>
    <div class="profile-dropdown" id="profileDropdown" >

        <a onclick="openModal('userProfileEditModal')" href="#" class="">
            <i class="las la-user"></i>
            Editar perfil
        </a>
        <a onclick="openModal('logoutModal')" href="#" class="nav-danger">
            <i class="las la-sign-out-alt"></i>
            Salir
        </a>

    </div>
</div>



<?php include(__DIR__ . '../../modals/confirmLogoutModal.php') ?>
<?php include(__DIR__ . '../../modals/userProfileEditModal.php') ?>
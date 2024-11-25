<?php
$user_full_name = Auth::user()->first_name . ' ' . Auth::user()->last_name;
?>
<div class="auth-navbar">
    <a href="/apply">
        <img class="logotype" src="/<?= asset('logo/SVG/vetcamp_full_hoz_b.svg') ?>" alt="Vetcamp Logo">
    </a>
    <a href="#" class="main-action-bright quaternary" onclick="toggleDropdown('profileDropdown')">
        <h3><?= $user_full_name ?></h3>
        <i class="las la-caret-down"></i>
    </a>
    <div class="profile-dropdown" id="profileDropdown">

        <a href="#" class="main-action-bright danger">
            <i class="las la-sign-out-alt"></i>
            <span onclick="openModal('logoutModal')">Salir</span>
        </a>
    </div>
</div>

<?php include(__DIR__ . '../../modals/confirmLogoutModal.php') ?>
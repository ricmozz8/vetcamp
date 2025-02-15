<!-- Sidebar navigation -->
<?php
if (!isset($selected)) {
    $selected = '';
}
?>

<aside id="sidebar" class="sidebar">

    <!-- Close sidebar button -->
    <a onclick="closeModal('sidebar')" class=" close-sidebar">
        <i class="las la-times"></i>
    </a>
    <!-- Logo section -->
    <a class="sidebar-logo" href="/admin">
        <img src="/<?= asset('logo/SVG/admin_logo_black.svg'); ?>" alt="">
    </a>

    <!-- Main navigation menu -->
    <nav class="nav-links">
        <a href="/admin" class="nav-item <?php if ($selected == 'start') {
            echo 'active';
        } ?>">
            <i class="las la-home"></i>
            <span>Inicio</span>
        </a>
        <a href="/admin/requests" class="nav-item <?php if ($selected == 'requests') {
            echo 'active';
        } ?>">
            <i class="las la-id-badge"></i>
            <span>Solicitudes</span>
        </a>
        <a href="/admin/registered" class="nav-item <?php if ($selected == 'registered') {
            echo 'active';
        } ?>">
            <i class="las la-user-friends"></i>
            <span>Usuarios</span>
        </a>
        <a href="/admin/accepted" class="nav-item <?php if ($selected == 'accepted') {
            echo 'active';
        } ?>">
            <i class="las la-check"></i>
            <span>Aceptados</span>
        </a>
        <a href="/admin/settings" class="nav-item <?php if ($selected == 'settings') {
            echo 'active';
        } ?>">
            <i class="las la-cog"></i>
            <span>Ajustes</span>
        </a>
        <hr>

        <p class="sidebar-section">
            <i class="las la-wrench"></i>
            Developer tools
        </p>

        <a href="/admin/dev/errors" class="nav-item <?php if ($selected == 'errors') {
            echo 'active';
        } ?>">
            <i class="las la-bug"></i>
            <span>Error log</span>
        </a>
    </nav>

    <!-- User profile section -->
    <div class="user-profile">
        <?php
        $badgeUser = Auth::user();
        require 'userBadge.php'
        ?>
        <div class="user-info">
            <a href="#" onclick="openModal('userProfileEditModal')" class="w-fit main-action-bright quaternary-squared">
                <i class="las la-cog"></i>
                <span>Editar perfil</span>
            </a>
            <h3 class="user-name"><?php echo Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></h3>
            <span class="user-email" id="userEmail"><?php echo Auth::user()->email; ?></span>
            <a href="#" onclick="openModal('logoutModal')" class="logout">Salir</a>
        </div>
    </div>
</aside>
<?php include(__DIR__ . '../../modals/confirmLogoutModal.php') ?>
<?php include(__DIR__ . '../../modals/userProfileEditModal.php') ?>
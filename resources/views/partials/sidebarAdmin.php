<!-- Sidebar navigation -->
<aside id="sidebar" class="sidebar">

        <!-- Close sidebar button -->
        <a onclick="closeModal('sidebar')" class=" close-sidebar">
                <i class="las la-times"></i>
        </a>
        <!-- Logo section -->
        <a class="sidebar-logo" href="/admin">
        <?php require_once('applicationLogo.php'); ?>
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
                        <span>Registrados</span>
                </a>
                <a href="/admin/accepted" class="nav-item <?php if ($selected == 'accepted') {
                                                                        echo 'active';
                                                                }  ?>">
                        <i class="las la-check"></i>
                        <span>Aceptados</span>
                </a>
                <a href="/admin/settings" class="nav-item <?php if ($selected == 'settings') {
                                                                        echo 'active';
                                                                } ?>">
                        <i class="las la-cog"></i>
                        <span>Ajustes</span>
                </a>
        </nav>

        <!-- User profile section -->
        <div class="user-profile">
                <!--<?php echo "<div class='user-avatar' id='userAvatar'><img src='Auth::user()->url_picture;'></div>"; ?>-->
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
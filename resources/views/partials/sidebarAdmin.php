<!-- Sidebar navigation -->
<aside class="sidebar">
        <!-- Logo section -->
        <div class="sidebar-logo">
                <img src="/resources/assets/logo/SVG/vetcamp_full_ver_b.svg" alt="Vetcamp" class="logo logo-right">
        </div>

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
                <a href="#" class="nav-item">
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
                        <a href="#" class="w-fit">
                                <i class="las la-cog"></i>
                        </a>
                        <h3 class="user-name"><?php echo Auth::user()->first_name . ' ' . Auth::user()->last_name; ?></h3>
                        <span class="user-email" id="userEmail"><?php echo Auth::user()->email; ?></span>
                        <a href="#" onclick="openModal('logoutModal')" class="logout">Salir</a>
                </div>
        </div>
</aside>
<?php include(__DIR__ . '../../modals/confirmLogoutModal.php') ?>
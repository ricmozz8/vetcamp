<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';

require __DIR__ . '/modals/sessionEditModal.php';
require __DIR__ . '/modals/limitDateEditModal.php';
require __DIR__ . '/modals/editMessageApproved.php';
require __DIR__ . '/modals/editMessageDenied.php';
require __DIR__ . '/modals/editMessageAll.php';
require __DIR__ . '/modals/confirmArchiveModal.php';
require __DIR__ . '/modals/confirmDeleteAllApplicationsModal.php';
require __DIR__ . '/modals/confirmDeleteDeniedModal.php';
require __DIR__ . '/modals/createAdminModal.php';
require __DIR__ . '/modals/confirmDisableUnsolicitedModal.php';
require __DIR__ . '/modals/confirmDisableAllModal.php';
require __DIR__ . '/modals/confirmDeleteNoAppUsersModal.php';
require __DIR__ . '/modals/editPicturesModal.php';
require __DIR__ . '/modals/uploadLiabilityWaiver.php';
?>

<body>
<!--- Define your structure here --->
<?php require_once('partials/profileNav.php'); ?>
<div class="back-dash">

    <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

    <a onclick="openModal('sidebar')" href="#" class="openSidebar">
        <i class="fas fa-bars">
        </i>
    </a>

    <!-- Main content area -->
    <main class="main-content">
        <!-- primary logo container -->

        <header class="header">
            <h1 class="welcome"> Ajustes </h1>
        </header>

        <div class="settings-cards">

            <!-- Vetcamp dates area -->
            <div class="settings-category-group">
                <div class="title-group">
                        <span class="colored-icon-setting">
                        <img src="/<?= asset('logo/SVG/vetcamp-icon-black.svg') ?>" alt="vetcamp-icon">
                            </span>
                    <p class="setting-title"> Manejar el campamento </p>
                </div>


                <div class="settings-block">
                    <p> Manejar sesiones del campamento </p>
                    <button class="main-action-bright primary" onclick="openModal('sessionEditModal')"> Editar</button>
                </div>
                <div class="settings-block">
                    <p> Manejar fechas límites de registros </p>
                    <button class="main-action-bright primary" onclick="openModal('limitDateEditModal')"> Editar
                    </button>
                </div>
                <div class="settings-block">
                    <p> Manejar fotos de la página de inicio </p>
                    <button class="main-action-bright primary" onclick="openModal('editPicturesModal')"> Editar</button>
                </div>
                <div class="settings-block">
                    <p> Manejar el archivo de descargo de responsabilidad</p>
                    <button class="main-action-bright primary" onclick="openModal('uploadLiabilityWaiver')"> Editar</button>
                </div>
            </div>


            <!-- Predefined messages area -->
            <div class="settings-category-group">
                <div class="title-group">
                    <span class="colored-icon-setting"><i class="fas fa-bullhorn"></i></span>
                    <p class="setting-title"> Editar mensajes predeterminados </p>
                </div>

                <dark-text-color>
                    <div class="settings-block">
                        <p> Editar mensaje para aprobados </p>
                        <button class="main-action-bright primary" onclick="openModal('editMessageApproved')"> Editar
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Editar mensaje para denegados </p>
                        <button class="main-action-bright primary" onclick="openModal('editMessageDenied')"> Editar
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Editar mensaje masivo </p>
                        <button class="main-action-bright primary" onclick="openModal('editMessageAll')"> Editar
                        </button>
                    </div>
            </div>


            <!-- Request management area -->
            <div class="settings-category-group">
                <div class="title-group">
                    <span class="colored-icon-setting"><i class="fas fa-clipboard"></i></span>
                    <p class="setting-title"> Manejar solicitudes </p>
                </div>

                <dark-text-color>
                    <div class="settings-block">
                        <p> Archivar solicitudes </p>
                        <button class="main-action-bright primary" onclick="openModal('confirmArchiveModal')">
                            Archivar
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Eliminar todas las solicitudes </p>
                        <button class="main-action-bright danger"
                                onclick="openModal('confirmDeleteAllApplicationsModal')"> Borrar
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Eliminar las solicitudes denegadas </p>
                        <button class="main-action-bright danger" onclick="openModal('confirmDeleteDeniedModal')">
                            Borrar
                        </button>
                    </div>
            </div>


            <!-- Account management area -->
            <div class="settings-category-group">
                <div class="title-group">
                    <span class="colored-icon-setting"><i class="fas fa-user"></i></span>
                    <p class="setting-title"> Administrar cuentas </p>
                </div>


                <dark-text-color>
                    <div class="settings-block">
                        <p> Crear una cuenta de administrador </p>
                        <button class="main-action-bright primary" onclick="openModal('createAdminModal')"> Crear
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Eliminar cuentas sin solicitud </p>
                        <button class="main-action-bright danger" onclick="openModal('confirmDeleteNoAppUsersModal')">
                            Borrar
                        </button>
                    </div>
                    <!-- <div class="settings-block">
                        <p> Desactivar cuentas que no solicitaron </p>
                        <button class="main-action-bright danger" onclick="openModal('confirmDisableUnsolicitedModal')">
                            Desactivar
                        </button>
                    </div>
                    <div class="settings-block">
                        <p> Desactivar todas las cuentas </p>
                        <button class="main-action-bright danger" onclick="openModal('confirmDisableAllModal')">
                            Desactivar
                        </button>
                    </div> -->
            </div>
        </div>


    </main>
</div>

<!-- Footer with copyright information -->
<?php require_once('partials/footer.php'); ?>
</body>

</html>
<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>
<?php if (isset($_SESSION['success_message'])): ?>
    <div class="alert alert-success">
        <?= $_SESSION['success_message']; ?>
        <?php unset($_SESSION['success_message']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error_message'])): ?>
    <div class="alert alert-danger">
        <?= $_SESSION['error_message']; ?>
        <?php unset($_SESSION['error_message']); ?>
    </div>
<?php endif; ?>
<body>
    <!--- Define your structure here --->
    <div class="back-dash">

        <!-- Sidebar navigation -->
        <aside class="sidebar">
            <!-- Logo section -->
            <div class="logo-container">
                <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
            </div>

            <!-- Main navigation menu -->
            <nav class="nav-links">
                <a href="/admin" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                    <span>Inicio</span>
                </a>
                <a href="requests" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                    <span>Solicitudes</span>
                </a>
                <a href="registered" class="nav-item">
                    <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                    <span>Registrados</span>
                </a>
                <a href="settings" class="nav-item active">
                    <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                    <span>Ajustes</span>
                </a>
            </nav>

            <!-- User profile section -->
            <div class="user-profile">
                <div class="user-avatar" id="userAvatar">U</div>
                <div class="user-info">
                    <span class="user-email" id="userEmail">usuario@correo.com</span>
                    <a href="#" class="logout">Salir</a>
                </div>
            </div>
        </aside>

        <!-- Main content area -->
        <main class="main-content">
        <!-- Secondary logo container -->
            <div class="logo-container">
                <img src="/resources/assets/logo/PNG/vetcamp_full_hoz_b.png" alt="Vetcamp" class="logo logo-right">
            </div>
        <header class="header">
            <h1 class="welcome"> Ajustes </h1>
        </header>

        <!-- Vetcamp dates area -->
        <div>
            <h2 class="stat-title"> Manejar fechas del campamento </h2>
            <br><hr size="2" color=000000>
            <div class="settings-block">
                <h3> Manejar sesiones del campamento </h3>
                <button class="edit-button" onclick="openModal('sessionsPopup')"> Editar </button>
            </div>
            <div class="settings-block">
                <h3> Manejar fechas limites de registros </h3>
                <button class="edit-button" onclick="openModal('datesPopup')"> Editar </button>
            </div>
        </div>

        <!-- Predefined messages area -->
        <div>
            <h2 class="stat-title"> Manejar mensajes predefinidos </h2>
            <br><hr size="2" color=000000>
            <div class="settings-block">
                <h3> Editar mensaje para aprobados </h3>
                <button class="edit-button" onclick="openModal('approvedPopup')"> Editar </button>
            </div>
            <div class="settings-block">
                <h3> Editar mensaje para denegados </h3>
                <button class="edit-button" onclick="openModal('rejectedPopup')"> Editar </button>
            </div>
            <div class="settings-block">
                <h3> Editar mensaje masivo  </h3>
                <button class="edit-button" onclick="openModal('genericPopup')"> Editar </button>
            </div>
        </div>

        <!-- Request management area -->
        <div>
            <h2 class="stat-title"> Administrar solicitudes </h2>
            <br><hr size="2" color=000000>
            <div class="settings-block">
                <h3> Archivar solicitudes </h3>
                <button class="edit-button" onclick="openModal('archivePopup')"> Archivar </button>
            </div>
            <div class="settings-block">
                <h3> Eliminar todas las solicitudes </h3>
                <button class="erase-button" onclick="openModal('allRequestsPopup')"> Borrar </button>
            </div>
            <div class="settings-block">
                <h3> Eliminar las solicitudes denegadas </h3>
                <button class="erase-button" onclick="openModal('rejectedRequestsPopup')"> Borrar </button>
            </div>
        </div>

        <!-- Account management area -->
        <div>
            <h2 class="stat-title"> Administrar cuentas </h2>
            <br><hr size="2" color=000000>
            <div class="settings-block">
                <h3> Desactivar cuentas que no solicitaron </h3>
                <button class="erase-button" onclick="openModal('unsolicitedPopup')"> Desactivar </button>
            </div>
            <div class="settings-block">
                <h3> Desactivar todas las cuentas </h3>
                <button class="erase-button" onclick="openModal('allPopup')"> Desactivar </button>
            </div>
        </div>


        </main>
    </div>

    <!-- Modal Popup -->
    <!-- The overlay provides a semi-transparent dark background behind the popup -->
    <div class="popup-overlay" id="popupOverlay" style="display: none"></div>

    <!-- Main popup container with the form -->
    <div class="message-popup" id="sessionsPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('sessionsPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Manejar sesiones</h2>

        <!-- Message area -->
        <div class="message-options">
            <h3> Año 2024 </h3>
        </div>

        <br>

        <!-- Main modal area -->
        <div class="session-modal-area">

            <!-- Session modification area -->
            <div class="session-modal-edit-area">

                <!-- Individual line area (this is where the loop would be placed) -->
                <div class="session-modal-edit">
                    <button class="trash-button"><i class="las la-trash"></i></button>
                    <input type="text" class="session-edit-input" name="NAME"/>
                    <input type="date" class="session-edit-input" name="NAME"/>
                    <input type="date" class="session-edit-input" name="NAME"/>
                </div>
                
            </div>
        </div>

    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="datesPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('datesPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Manejar fechas límite</h2>

        <br>

        <!-- Main modal area -->
        <div class="session-modal-area">

            <!-- Session modification area -->
            <div class="session-modal-edit-area">

                <!-- Individual line area (this is where the loop would be placed) -->
                <div class="session-modal-dates">
                    <label for="startDate">Inicio:</label>
                    <input class="session-date-input" type="date" name="startDate"/>

                    <label for="endDate">Cierre:</label>
                    <input class="session-date-input" type="date" name="endDate"/>
                </div>
                
            </div>
        </div>

        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('datesPopup')">Cancelar</button>

            <!-- Save button -->
            <button class="secondary main-action-bright" onclick="closeModal('datesPopup')">Guardar</button>
        </div>

    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="approvedPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('approvedPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Editar mensaje predeterminado para aceptados</h2>

        <!-- Form area -->
        <form method="post" action="settings/e/approved">
            <!-- Message input area -->
            <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['approved']['content'] ?></textarea>
            <input name="id" type="hidden" value="<?= $messages['approved']['id'] ?>">

            <!-- Send button -->
            <button class="secondary main-action-bright" onclick="closeModal('approvedPopup')"><i class="las la-envelope"> </i>Guardar</button>
        </form>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="rejectedPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('rejectedPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Editar mensaje predeterminado para denegados</h2>

        <!-- Form area -->
        <form method="post" action="settings/e/rejected">
            <!-- Message input area -->
            <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['denied']['content'] ?></textarea>
            <input name="id" type="hidden" value="<?= $messages['denied']['id'] ?>">
            <!-- Send button -->
            <button class="secondary main-action-bright" onclick="closeModal('rejectedPopup')"><i class="las la-envelope"> </i>Guardar</button>
        </form>
    </div>

    <!-- genericPopup -->

    <div class="message-popup" id="genericPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('genericPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Editar mensaje predeterminado para todos</h2>

        <!-- Form area -->
        <form method="post" action="settings/e/all">
            <!-- Message input area -->
            <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['all']['content'] ?></textarea>
            <input name="id" type="hidden" value="<?= $messages['all']['id'] ?>">
            <!-- Send button -->
            <button class="secondary main-action-bright" onclick="closeModal('rejectedPopup')"><i class="las la-envelope"> </i>Guardar</button>
        </form>
    </div>

    <!-- Main popup container with the form -->
    <div class="message-popup" id="allRequestsPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('allRequestsPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">¿Desea eliminar todas las solicitudes?</h2>

        <!-- Alert -->
        <div class="message-options">
            <h3> Esta acción no se prodra revertir... </h3>
        </div>


        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</button>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="rejectedRequestsPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('rejectedRequestsPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">¿Desea eliminar las solicitudes denegadas?</h2>

        <!-- Alert -->
        <div class="message-options">
            <h3> Esta acción no se prodra revertir... </h3>
        </div>


        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</button>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="unsolicitedPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('unsolicitedPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">¿Desea desactivar las cuentas que no solicitaron?</h2>

        <!-- Alert -->
        <div class="message-options">
            <h3> Esta acción no se prodra revertir... </h3>
        </div>


        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</button>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="allPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('allPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">¿Desea desactivar todas las cuentas?</h2>

        <!-- Alert -->
        <div class="message-options">
            <h3> Esta acción no se prodra revertir... </h3>
        </div>


        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</button>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="addSessionsPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('addSessionsPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Añadir sesión</h2>

        <!-- Message filter options -->
        <div class="message-options">
            <!-- Filter buttons for different message states -->
            <button id="approvedButton" class="option-button">
                <div class="option-indicator">
                    <div class="indicator-dot"></div>
                </div>
                <span class="option-text">Aprobados</span>
            </button>
            <button class="option-button" id="deniedButton">
                <div class="option-indicator">
                    <div class="indicator-dot"></div>
                </div>
                <span class="option-text">Denegados</span>
            </button>
            <button class="option-button" id="allButton">
                <div class="option-indicator">
                    <div class="indicator-dot"></div>
                </div>
                <span class="option-text">Todos</span>
            </button>


            <select class="form-rounded" name="section" id="sectionDropdown" style="display: none;">
                <option value="">Seleccione una sección</option>
                <option value="1">Sección 1</option>
                <option value="2">Sección 2</option>
                <option value="3">Sección 3</option>
                <option value="4">Sección 4</option>
            </select>
        </div>

        <!-- Preset message option -->
        <label class="preset-message">
            <input type="checkbox" class="preset-checkbox" id="usePresetMessage">
            <span>Utilizar Mensajes Predefinidos</span>
        </label>

        <!-- Message input area -->
        <textarea class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"></textarea>

        <!-- Send button -->
        <button class="secondary main-action-bright">Enviar</button>
    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="archivePopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('archivePopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">¿Desea archivar las solicitudes?</h2>

        <!-- Alert -->
        <div class="message-options">
            <h3> Esta acción no se prodra revertir... </h3>
        </div>


        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <button class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</button>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>

    <!--<script src="<?= web_resource("js/backendDashboard.js")?>"></script>-->

    <!-- Footer with copyright information -->
    <?php require_once('partials/footer.php'); ?>
</body>
</html>
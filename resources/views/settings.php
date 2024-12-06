<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!--- Define your structure here --->
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <a onclick="openModal('sidebar')" href="#" class="openSidebar">
            <i class="las la-bars">
            </i>
        </a>

        <!-- Main content area -->
        <main class="main-content">
            <!-- Secondary logo container -->

            <header class="header">
                <h1 class="welcome"> Ajustes </h1>
            </header>

            <div class="settings-cards">

                <!-- Vetcamp dates area -->
                <div class="settings-category-group">
                    <div class="title-group">
                        <span class="colored-icon-setting"><i class="las la-calendar"></i></span>
                        <p class="setting-title"> Manejar fechas del campamento </p>
                    </div>



                    <div class="settings-block">
                        <p> Manejar sesiones del campamento </p>
                        <button class="main-action-bright secondary" onclick="openModal('sessionsPopup')"> Editar </button>
                    </div>
                    <div class="settings-block">
                        <p> Manejar fechas limites de registros </p>
                        <button class="main-action-bright secondary" onclick="openModal('datesPopup')"> Editar </button>
                    </div>
                </div>


                <!-- Predefined messages area -->
                <div class="settings-category-group">
                    <div class="title-group">
                        <span class="colored-icon-setting"><i class="las la-bullhorn"></i></span>
                        <p class="setting-title"> Editar mensajes predeterminados </p>
                    </div>

                    <dark-text-color>
                        <div class="settings-block">
                            <p> Editar mensaje para aprobados </p>
                            <button class="main-action-bright secondary" onclick="openModal('approvedPopup')"> Editar </button>
                        </div>
                        <div class="settings-block">
                            <p> Editar mensaje para denegados </p>
                            <button class="main-action-bright secondary" onclick="openModal('rejectedPopup')"> Editar </button>
                        </div>
                        <div class="settings-block">
                            <p> Editar mensaje masivo </p>
                            <button class="main-action-bright secondary" onclick="openModal('genericPopup')"> Editar </button>
                        </div>
                </div>


                <!-- Request management area -->
                <div class="settings-category-group">
                    <div class="title-group">
                        <span class="colored-icon-setting"><i class="las la-clipboard"></i></span>
                        <p class="setting-title"> Manejar solicitudes </p>
                    </div>

                    <dark-text-color>
                        <div class="settings-block">
                            <p> Archivar solicitudes </p>
                            <button class="main-action-bright secondary" onclick="openModal('archivePopup')"> Archivar </button>
                        </div>
                        <div class="settings-block">
                            <p> Eliminar todas las solicitudes </p>
                            <button class="main-action-bright danger" onclick="openModal('allRequestsPopup')"> Borrar </button>
                        </div>
                        <div class="settings-block">
                            <p> Eliminar las solicitudes denegadas </p>
                            <button class="main-action-bright danger" onclick="openModal('rejectedRequestsPopup')"> Borrar </button>
                        </div>
                </div>


                <!-- Account management area -->
                <div class="settings-category-group">
                    <div class="title-group">
                        <span class="colored-icon-setting"><i class="las la-user"></i></span>
                        <p class="setting-title"> Administrar cuentas </p>
                    </div>


                    <dark-text-color>
                        <div class="settings-block">
                            <p> Crear una cuenta de administrador </p>
                            <button class="main-action-bright secondary" onclick="openModal('addAdminModal')"> Crear </button>
                        </div>
                        <div class="settings-block">
                            <p> Desactivar cuentas que no solicitaron </p>
                            <button class="main-action-bright danger" onclick="openModal('unsolicitedPopup')"> Desactivar </button>
                        </div>
                        <div class="settings-block">
                            <p> Desactivar todas las cuentas </p>
                            <button class="main-action-bright danger" onclick="openModal('allPopup')"> Desactivar </button>
                        </div>
                </div>
            </div>


        </main>
    </div>

    <!-- Modal Popup -->
    <!-- The overlay provides a semi-transparent dark background behind the popup -->
    <div class="popup-overlay" id="popupOverlay" style="display: none"></div>

    <!-- Main popup container with the form -->
    <div class="message-popup" id="sessionsPopup" style="display: none">
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('sessionsPopup')">
            <i class="las la-times"></i>
        </a>

        <h2 class="message-title">Manejar sesiones</h2>

        <!-- Message area -->
        <div class="message-options">
            <h3>Año 2024</h3>
        </div>


        <!-- Form for managing existing sessions -->
        <form action="/sessions/update" method="POST">
            <div class="session-modal-edit-area">
                <?php $session_array = []; ?>
                <?php foreach ($sessions as $index => $session): ?>
                    <div class="session-modal-edit">
                        <button type="submit" class="trash-button" name="delete_session" value="<?php echo $session->session_id; ?>"> 
                        <i class="las la-trash"></i> </button>
                        <input type="hidden" name="sessions[<?php echo $index; ?>][id]" value="<?php echo $session->session_id ?>" />
                        <input type="text" class="session-edit-input" name="sessions[<?php echo $index; ?>][title]" value="<?php echo $session->title ?>" />
                        <input type="date" class="session-edit-input" name="sessions[<?php echo $index; ?>][start_date]" value="<?php echo $session->start_date ?>" />
                        <input type="date" class="session-edit-input" name="sessions[<?php echo $index; ?>][end_date]" value="<?php echo $session->end_date ?>" />
                    </div>
                    <?php {
                        $session_array[$session->session_id] =
                            [
                                'title' => $session->title,
                                'start_date' => $session->start_date,
                                'end_date' => $session->end_date
                            ];
                    }
                    ?>
                <?php endforeach; ?>
            </div>

            <!-- Buttons area -->
            <div class="modal-actions">
                <a href="#" type="button" class="primary main-action-bright" onclick="openModal('addSessionsPopup')">Crear sesión</a>
                <a href="#" type="button" class="primary main-action-bright" onclick="closeModal('sessionsPopup')">Cancelar</a>
                <button type="input" type="hidden" name="" class="secondary main-action-bright">Guardar</button>
            </div>
        </form>
    </div>

    <!-- Popup for adding a new session -->
    <div class="message-popup" id="addSessionsPopup" style="display: none">
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('addSessionsPopup')">
            <i class="las la-times"></i>
        </a>

        <h2 class="message-title">Añadir nueva sesión</h2>

        <div class="message-options">
            <h3>Escriba un título para la sesión y establezca las fechas</h3>
        </div>


        <!-- Form for adding a new session -->
        <form action="/sessions/create" method="POST">
            <div class="session-modal-edit-area">
                <div class="session-modal-edit">
                    <input type="text" class="session-edit-input" name="new_sessions[0][title]" placeholder="Título de la nueva sesión" />
                    <input type="date" class="session-edit-input" name="new_sessions[0][start_date]" />
                    <input type="date" class="session-edit-input" name="new_sessions[0][end_date]" />
                </div>
            </div>

            <!-- Buttons area -->
            <div class="modal-actions">
                <a href="#" type="button" class="primary main-action-bright" onclick="closeModal('addSessionsPopup')">Cancelar</a>
                <button type="submit" class="secondary main-action-bright">Guardar</button>
            </div>
        </form>
    </div>
    <!-- Main popup container with the form -->
    <div class="message-popup" id="datesPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('datesPopup')"><i class="las la-times"></i></a>


        <!-- Popup title -->
        <h2 class="message-title">Manejar fechas límite</h2>
        <p>Manejar las fechas límite para el registro del campamento.</p>



        <form action="settings/e/dates" style="width: 100%;" method="POST">
            <!-- Main modal area -->
            <div class="session-modal-area">
                <!-- Session modification area -->
                <div class="session-modal-edit-area">

                    <!-- Individual line area -->
                    <div class="session-modal-dates">
                        <label for="startDate">Inicio:</label>
                        <input value="<?= $limit_dates->start_date ?>" class="session-edit-input" type="date" name="startDate" />

                        <label for="endDate">Cierre:</label>
                        <input value="<?= $limit_dates->end_date ?>" class="session-edit-input" type="date" name="endDate" />
                    </div>

                </div>
            </div>

            <!-- Buttons area -->
            <div class="modal-actions">
                <!-- Cancel button -->
                <a href="#" class="primary main-action-bright" onclick="closeModal('datesPopup')">Cancelar</a>

                <!-- Save button -->
                <button class="secondary main-action-bright" onclick="closeModal('datesPopup')">Guardar</button>
            </div>
        </form>

    </div>


    <!-- Main popup container with the form -->
    <div class="message-popup" id="approvedPopup" style="display: none">
        <!-- Close button in the top-right corner -->
        <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
        <a href="#" class="plain-action" id="closePopup" onclick="closeModal('approvedPopup')"><i class="las la-times"></i></a>

        <!-- Popup title -->
        <h2 class="message-title">Editar mensaje predeterminado para aceptados</h2>

        <!-- Form area -->
        <form method="post" action="settings/e/approved" style="width: 100%;">
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
        <form method="post" action="settings/e/rejected" style="width: 100%;">
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
        <form method="post" action="settings/e/all" style="width: 100%;">
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

          <!-- Form to delete rejected requests -->
    <form action="/admin/delete/all/requests" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />

        <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <a href="#" class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</a>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
     </form>
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

         <!-- Form to delete rejected requests -->
    <form action="/admin/delete/rejected/requests" method="POST">
        <!-- CSRF Token -->
        <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>" />


        <!-- Buttons area -->
        <div class="modal-actions">
           <a href="#" class="primary main-action-bright" onclick="closeModal('rejectedRequestsPopup')">Cancelar</a>
           <button type="submit" class="secondary main-action-bright">Confirmar</button>
        </div>
       </form>
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
            <a href="#" class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</a>

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
            <a href="#" class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</a>

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
            <a href="#" class="primary main-action-bright" onclick="closeModal('archivePopup')">Cancelar</a>

            <!-- Confirm button -->
            <button class="secondary main-action-bright" onclick="closeModal('archivePopup')">Confirmar</button>
        </div>
    </div>

    <?php require_once('modals/createAdminModal.php'); ?>

    <!-- Footer with copyright information -->
    <?php require_once('partials/footer.php'); ?>
</body>

</html>

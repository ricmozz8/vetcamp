<!-- Main popup container with the form -->
<div class="message-popup" id="sessionEditModal" style="display: none">
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('sessionEditModal')">
        <i class="las la-times"></i>
    </a>

    <h2 class="message-title">Manejar sesiones</h2>

    <!-- Message area -->
    <div class="message-options">
        <h3> Cambie el título y las fechas de comienzo y final de cada sesión activa.  Recuerde presionar el botón de "Guardar" para preservar los cambios. </h3>
    </div>


    <!-- Form for managing existing sessions -->
    <form action="/sessions/update" method="POST">
        <div class="session-modal-edit-area">
            <?php $session_array = []; ?>
            <?php foreach ($sessions as $index => $session): ?>
                <div class="session-modal-edit">
                    <button type="submit" 
                    class="trash-button" 
                    name="delete_session" 
                    value="<?php echo $session->session_id; ?>" 
                    onclick="return confirmDelete(this);" 
                    data-title="<?php echo htmlspecialchars($session->title); ?>">
                    <script>
                    function confirmDelete(button) {
                    const sessionTitle = button.getAttribute('data-title') || "esta sesión";
                    return confirm(`¿Estás seguro de que deseas eliminar ${sessionTitle}?`);
                    }
                    </script>
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
            <a href="#" type="button" class="primary main-action-bright" onclick="openModal('addSessionsModal')">Crear sesión</a>
            <a href="#" type="button" class="primary main-action-bright" onclick="closeModal('sessionEditModal')">Cancelar</a>
            <button type="input" type="hidden" name="" class="secondary main-action-bright">Guardar</button>
        </div>
    </form>
</div>


<!-- Popup for adding a new session -->
<div class="message-popup" id="addSessionsModal" style="display: none">
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('addSessionsModal')">
        <i class="las la-times"></i>
    </a>

    <h2 class="message-title">Añadir nueva sesión</h2>

    <div class="message-options">
        <h3> Escriba un título y establezca las fechas de comienzo y final para crear una sesión nueva. </h3>
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
            <a href="#" type="button" class="primary main-action-bright" onclick="closeModal('addSessionsModal')">Cancelar</a>
            <button type="submit" class="secondary main-action-bright">Guardar</button>
        </div>
    </form>
</div>
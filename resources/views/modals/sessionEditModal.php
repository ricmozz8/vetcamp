<!-- Session Edit Modal -->
<div id="sessionEditModal" class="modal">
    <div class="modal-content">
    
        <!-- Close Button -->
        <span class="close-button" onclick="closeModal('sessionEditModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Title -->
        <h2>
            <i class="fas fa-calendar"></i>
            Manejar sesiones
        </h2>
        
        <form action="/sessions/update" method="POST">
    
            <?php $session_array = []; ?>
            <?php foreach ($sessions as $index => $session): ?>
                <div class="form-group" style="display: flex; flex-direction: row; align-items: center; gap: 15px;">
                    <button type="submit" 
                    class="trash-button" 
                    name="delete_session" 
                    value="<?php echo $session->session_id; ?>" 
                    onclick="return confirmDelete(this);" 
                    data-title="<?php echo htmlspecialchars($session->title); ?>">
                    <i class="las la-trash"></i> </button>
                    <input type="text" name="sessions[<?php echo $index; ?>][title]" id="session_title" value="<?php echo $session->title ?>" required >
                    <input type="date" name="sessions[<?php echo $index; ?>][start_date]" id="session_start_date" value="<?php echo $session->start_date ?>" required>
                    <input type="date" name="sessions[<?php echo $index; ?>][end_date]" id="session_end_date" value="<?php echo $session->end_date ?>" required>
                </div>
                <input type="hidden" name="sessions[<?php echo $index; ?>][id]" value="<?php echo $session->session_id ?>" />
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
            <div class="modal-actions" style="flex; flex-direction: row; align-items: center; gap: 15px;">
            <a href="#" type="button" class="secondary main-action-bright" onclick="closeModal('sessionEditModal')" style="background-color: white; color: #333;onmouseover="this.style.color='white'" onmouseout="this.style.color='#333'">Cancelar</a>
            <a href="#" type="button" class="tertiary main-action-bright" onclick="openModal('addSessionsModal')">Crear sesión</a>
        
                <button type="submit" class="main-action-bright primary"> 
                    <i class="fas fa-save"></i> 
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>


<!-- Popup for adding a new session -->
<div id="addSessionsModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('addSessionsModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-calendar"></i>
            Añadir nueva sesión
        </h2>
        
        <form action="/sessions/create" method="POST">
    
            <div class="form-group" style="padding: 10px; border-bottom: 1px solid #ccc;">
                <label for="new_session_title">Título de la nueva sesión</label>
                <input type="text" name="new_sessions[0][title]" id="new_session_title" placeholder="Título de la nueva sesión" required>
            </div>
            <div class="form-group" style="padding: 10px; border-bottom: 1px solid #ccc;">
                <label for="new_session_start_date">Fecha de inicio</label>
                <input type="date" name="new_sessions[0][start_date]" id="new_session_start_date" required>
            </div>
            <div class="form-group" style="padding: 10px; border-bottom: 1px solid #ccc;">
                <label for="new_session_end_date">Fecha de final</label>
                <input type="date" name="new_sessions[0][end_date]" id="new_session_end_date" required>
            </div>

            <div class="modal-actions" style="padding: 10px; border-top: 1px solid #ccc;">
                <a class="main-action-bright" onclick="closeModal('addSessionsModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="fas fa-save"></i> 
                    Guardar
                </button>
            </div>
          
        </form>
    </div>
</div>
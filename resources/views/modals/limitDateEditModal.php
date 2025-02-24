<div id="limitDateEditModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('limitDateEditModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-calendar"></i>
            Manejar fechas límite
        </h2>
        
        <form action="settings/e/dates" method="POST">
    
            <div class="form-group">
                <label for="startDate">Fecha de inicio</label>
                <input type="date" name="startDate" id="startDate" value="<?= $limit_dates->start_date ?>" required>
            </div>

            <div class="form-group">
                <label for="endDate">Fecha de cierre</label>
                <input type="date" name="endDate" id="endDate" value="<?= $limit_dates->end_date ?>" required>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('limitDateEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="fas fa-save"></i> 
                    Guardar
                </button>
            </div>
          
        </form>
    </div>
</div>
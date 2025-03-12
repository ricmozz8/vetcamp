<!-- Main popup container with the form -->
<div id="confirmDisableAllModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDisableAllModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="las la-lock"></i>
            ¿Desea desactivar todas las cuentas?
        </h2>
        
        <form action="/admin/disable/all/accounts" method="POST">
    
            <div class="form-group">
                <p>Esta acción eliminará los documentos de las cuentas y cambiará el estado de las mismas a "desactivada".  Esta acción no se podrá revertir...</p>
            </div>

            <div class="modal-actions">
                <a class="danger" onclick="closeModal('confirmDisableAllModal')">Cancelar</a>
                <button type="submit" class="danger" style="background: red !important; color: white !important;">
                    <i class="las la-lock"></i> 
                    Confirmar
                </button>
            </div>
            
        </form>
    </div>
</div>
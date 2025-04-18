<!-- Main popup container with the form -->
<div id="confirmDisableUnsolicitedModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDisableUnsolicitedModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-lock"></i>
            ¿Desea desactivar las cuentas que no solicitaron?
        </h2>
         
        <form action="/admin/disable/unsolicited/accounts" method="POST">
    
            <div class="form-group">
                <p>Esta acción eliminará los documentos de las cuentas y cambiará el estado de las mismas a "desactivada".  Esta acción no se podrá revertir...</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmDisableUnsolicitedModal')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-lock"></i>
                    Confirmar
                </button>
            </div>
          
        </form>
    </div>
</div>
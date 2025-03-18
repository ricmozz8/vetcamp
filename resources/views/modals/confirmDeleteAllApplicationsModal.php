<!-- Main popup container with the form -->
<div id="confirmDeleteAllApplicationsModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDeleteAllApplicationsModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-trash"></i>
            ¿Desea eliminar todas las solicitudes?
        </h2>
        
        <form action="/admin/delete/all/requests" method="POST">
    
            <div class="form-group">
                <p>Esta acción eliminará los documentos de las solicitudes pero las cuentas relacionadas continuarán con el estado "activo".  Esta acción no se podrá revertir...</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmDeleteAllApplicationsModal')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-trash"></i>
                    Confirmar
                </button>
            </div>
          
        </form>
    </div>
</div>
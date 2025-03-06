<!-- Main popup container with the form -->
<div id="confirmDeleteDeniedModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDeleteDeniedModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="las la-trash"></i>
            ¿Desea eliminar las solicitudes denegadas?
        </h2>
        
        <form action="/admin/delete/rejected/requests" method="POST">
    
            <div class="form-group">
                <p>Esta acción eliminará los documentos de las solicitudes pero las cuentas relacionadas continuarán con el estado "activo".  Esta acción no se podrá revertir...</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmDeleteDeniedModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="las la-trash"></i> 
                    Confirmar
                </button>
            </div>
          
        </form>
    </div>
</div>
<!-- Main popup container with the form -->
<div id="confirmArchiveModal" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmArchiveModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-archive"></i>
            ¿Desea archivar las solicitudes?
        </h2>
        
        <form action="/admin/settings/archive" method="POST">
    
            <div class="form-group">
                <p>Esta acción creará un documento con la información de las solicitudes actuales. Recuerde limpiar las listas para evitar documentos duplicados.</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmArchiveModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="fas fa-archive"></i>
                    Confirmar
                </button>
            </div>
          
        </form>
    </div>
</div>
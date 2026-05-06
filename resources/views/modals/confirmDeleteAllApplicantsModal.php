<!-- Main popup container with the form -->
<div id="confirmDeleteAllApplicantsModal" class="modal">
    <div class="modal-content">

        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDeleteAllApplicantsModal')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-trash"></i>
            ¿Desea eliminar todas las cuentas?
        </h2>

        <form action="/admin/delete/all/applicants" method="POST">

            <div class="form-group">
                <p>Esta acción eliminará todas las cuentas de usuarios (excepto administradores), incluyendo sus solicitudes, documentos y direcciones. Las cuentas de administrador no serán afectadas. Esta acción no se podrá revertir...</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmDeleteAllApplicantsModal')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-trash"></i>
                    Confirmar
                </button>
            </div>

        </form>
    </div>
</div>

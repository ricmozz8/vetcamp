<!-- Main popup container with the form -->
<div id="confirmDeleteNoAppUsersModal" class="modal">
    <div class="modal-content">
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('confirmDeleteNoAppUsersModal')">
            <i class="fas fa-times"></i>
        </span>
        <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-user-minus"></i>
            ¿Desea eliminar las cuentas sin solicitud?
        </h2>

        <form action="/admin/delete/no-application-users" method="POST">
            <div class="form-group">
                <p>Esta acción eliminará permanentemente las cuentas que nunca hayan enviado una solicitud. No se podrá revertir.</p>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('confirmDeleteNoAppUsersModal')">Cancelar</a>
                <button type="submit" class="main-action-bright danger">
                    <i class="fas fa-trash"></i>
                    Confirmar
                </button>
            </div>
        </form>
    </div>
</div>

<div id="confirmChangeUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmChangeUserModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-question-circle"></i>
        <h2>¿Estás seguro de que quieres cambiar el estado?</h2>
        <p>El estado del usuario cambiará en la base de datos.</p>
        <div class="modal-actions">
            <a href="#" class="main-action-bright" onclick="closeModal('confirmChangeUserModal')">Cancelar</a>
            <a href="#" id="confirmChangeStatusButton" class="main-action-bright gradiented">
                <i class="fas fa-paper-plane"></i> Aceptar
            </a>
        </div>
    </div>
</div>
<script>
    function confirmChangeStatus(userId, action) {
        // Almacena temporalmente los valores en el botón de confirmación
        const confirmButton = document.getElementById('confirmChangeStatusButton');
        confirmButton.href = `/admin/registered/r?id=${userId}&action=${action}`;

        // Muestra el modal
        openModal('confirmChangeUserModal');
    }
</script>

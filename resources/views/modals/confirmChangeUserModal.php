<form id="changeStatusForm" method="POST" action="/admin/registered/changestatus">
    <input type="hidden" name="user_id" id="changeStatusUserId">
    <input type="hidden" name="action" id="changeStatusAction">
</form>
<div id="confirmChangeUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmChangeUserModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-question-circle"></i>
        <h2 id="modalText">¿Estás seguro de que deseas cambiar el estado de este usuario?</h2>
        <p>Este cambio afectará el acceso y permisos del usuario en la plataforma.</p>

        <p>El estado del usuario se actualizará en el sistema.</p>
        <div class="modal-actions">
            <a href="#" class="main-action-bright" onclick="closeModal('confirmChangeUserModal')">Cancelar</a>
            <button type="button" class="main-action-bright gradiented" onclick="submitChangeStatus()">
            Aceptar
            </button>
        </div>
    </div>
</div>

<script>
    function confirmChangeStatus(userId, action) {
        document.getElementById('changeStatusUserId').value = userId;
        document.getElementById('changeStatusAction').value = action;

        let actionText = action === 'active' ? 'activar' : 'desactivar';
        document.getElementById('modalText').innerText = `¿Estás seguro de que deseas ${actionText} a este usuario?`;

        openModal('confirmChangeUserModal');
}

function submitChangeStatus() {
    document.getElementById('changeStatusForm').submit();
}

</script>

<form id="changeStatusForm" method="POST" action="/admin/registered/changestatus">
    <input type="hidden" name="user_id" id="changeStatusUserId">
    <input type="hidden" name="action" id="changeStatusAction">
</form>
<div id="confirmChangeUserModal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmChangeUserModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-question-circle"></i>
        <h2>Esta acción cambiará el estado del usuario en el sistema. ¿Desea continuar?</h2>
        <p>El estado del usuario se actualizará en el sistema.</p>
        <div class="modal-actions">
            <a href="#" class="main-action-bright" onclick="closeModal('confirmChangeUserModal')">Cancelar</a>
            <button type="button" class="main-action-bright gradiented" onclick="submitChangeStatus()">
            <i class="fa-solid fa-gear"></i> Aceptar
            </button>
        </div>
    </div>
</div>

<script>
    function confirmChangeStatus(userId, action) {
        document.getElementById('changeStatusUserId').value = userId;
        document.getElementById('changeStatusAction').value = action;
        openModal('confirmChangeUserModal');
}

function submitChangeStatus() {
    document.getElementById('changeStatusForm').submit();
}

</script>

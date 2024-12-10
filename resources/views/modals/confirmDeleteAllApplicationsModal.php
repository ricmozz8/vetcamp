<!-- Main popup container with the form -->
<div class="message-popup" id="confirmDeleteAllApplicationsModal" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('confirmDeleteAllApplicationsModal')"><i class="las la-times"></i></a>

    <!-- Popup title -->
    <h2 class="message-title">¿Desea eliminar todas las solicitudes?</h2>

    <!-- Alert -->
    <div class="message-options">
        <h3> Esta acción eliminará los documentos de las solicitudes pero las cuentas relacionadas continuarán con el estado "activo".  Esta acción no se podrá revertir... </h3>
    </div>


    <!-- Buttons area -->
    <div class="modal-actions">
        <!-- Cancel button -->
        <a href="#" class="primary main-action-bright" onclick="closeModal('confirmDeleteAllApplicationsModal')">Cancelar</a>

        <!-- Confirm button -->
        <button class="secondary main-action-bright" onclick="closeModal('confirmDeleteAllApplicationsModal')">Confirmar</button>
    </div>
</div>
<!-- Main popup container with the form -->
<div class="message-popup" id="confirmDisableUnsolicitedModal" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('confirmDisableUnsolicitedModal')"><i class="las la-times"></i></a>

    <!-- Popup title -->
    <h2 class="message-title">¿Desea desactivar las cuentas que no solicitaron?</h2>

    <!-- Alert -->
    <div class="message-options">
        <h3> Esta acción eliminará los documentos de las cuentas y cambiará el estado de las mismas a "desactivada".  Esta acción no se podrá revertir... </h3>
    </div>


    <!-- Buttons area -->
    <div class="modal-actions">
        <!-- Cancel button -->
        <a href="#" class="secondary main-action-bright" onclick="closeModal('confirmDisableUnsolicitedModal')">Cancelar</a>

        <!-- Confirm button -->
        <button class="primary main-action-bright" onclick="closeModal('confirmDisableUnsolicitedModal')">Confirmar</button>
    </div>
</div>
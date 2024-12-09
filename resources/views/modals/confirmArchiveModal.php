<!-- Main popup container with the form -->
<div class="message-popup" id="confirmArchiveModal" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('confirmArchiveModal')"><i class="las la-times"></i></a>

    <!-- Popup title -->
    <h2 class="message-title">¿Desea archivar las solicitudes?</h2>

    <!-- Alert -->
    <div class="message-options">
        <h3> Esta acción no se prodra revertir... </h3>
    </div>


    <form action="/admin/settings/archive" method="POST">
            <!-- Buttons area -->
        <div class="modal-actions">
            <!-- Cancel button -->
            <a href="#" class="primary main-action-bright" onclick="closeModal('confirmArchiveModal')">Cancelar</a>

            <!-- Confirm button -->
            <button type="submit" class="secondary main-action-bright">Confirmar</button>
        </div>
    </form>
</div>
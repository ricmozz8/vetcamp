<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="/mail" method="POST">
                <div class="form-group">
                    <label for="user_type">Por estado</label>
                    <select required name="user_type" id="select-type">
                        <option value="approved">Aceptados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="applicants">Solicitantes</option>
                        <option value="interested">Interesados</option>
                        <option value="all">Todos</option>
                    </select>
                </div>

                
                <textarea required name="message" id="message-text" placeholder="Introduce un mensaje aquí..."></textarea>
                
                <div class="form-group flex-min">
                    <input type="checkbox" id="predefined-message" name="predefined">
                    <label for="predefined-message">Mensaje predefinido</label>
                </div>

        </div>

        <div class="modal-actions">
            <a href="#" onclick="closeModal('massiveEmailModal')" class="main-action-bright">Cancelar</a>
            <button type="submit" class="main-action-bright primary"><i class="fas fa-paper-plane"></i> Enviar</button>
        </div>
        </form>
    </div>
</div>

<script>
function resetMessage() {
    let checkbox = document.getElementById('predefined-message');
    let messageBox = document.getElementById('message-text');

    checkbox.checked = false;
    messageBox.value = '';
}

document.addEventListener("DOMContentLoaded", function() {
    let checkbox = document.getElementById('predefined-message');
    let messageBox = document.getElementById('message-text');
    let selectType = document.getElementById('select-type');

    // insert message in PHP with JSON
    let messagesData = <?= isset($messages) ? json_encode($messages, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) : '{}' ?>;

    function updateCheckboxVisibility() {
        let hasMessage = messagesData[selectType.value] !== undefined;
        checkbox.parentElement.style.display = hasMessage ? 'flex' : 'none';

        // hidden and clean
        if (!hasMessage) {
            checkbox.checked = false;
            messageBox.value = '';
        }
    }

    updateCheckboxVisibility();

    checkbox.addEventListener('change', function() {
        messageBox.value = this.checked && messagesData[selectType.value] ? messagesData[selectType.value] : "";
    });

    selectType.addEventListener('change', function() {
        updateCheckboxVisibility();
        if (checkbox.checked) {
            messageBox.value = messagesData[this.value] || "";
        }
    });
});
</script>



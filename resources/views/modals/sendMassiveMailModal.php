<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="/mail" method="POST">
                <div class="form-group">
                    <label for="user_type">Por estado</label>
                    <select required name="user_type" id="select-type" onchange="resetMessage()">
                        <option value="approved">Aceptados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="applicants">Solicitantes</option>
                        <option value="interested">Interesados</option>
                        <option value="all">Todos</option>
                    </select>
                </div>

                <!-- Checkbox de mensaje predefinido -->
                <div class="form-group">
                    <input type="checkbox" id="predefined-message" name="predefined">
                    <label for="predefined-message">Mensaje predefinido</label>
                </div>

                <!-- Campo de mensaje -->
                <textarea required name="message" id="message-text" placeholder="Introduce un mensaje aquí..."></textarea>

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

    checkbox.addEventListener('change', function() {
    if (this.checked) {
        let userType = selectType.value;

        // Get without refresh
        fetch(`/mail?user_type=${userType}`)
            .then(response => response.json())
            .then(data => {
                if (data.message) {
                    messageBox.value = data.message;
                } else {
                    messageBox.value = "";
                    if (data.error) {
                        alert(data.error);
                    }
                }
            })
            .catch(error => {
                console.error('Error al obtener el mensaje:', error);
                messageBox.value = "Error al cargar el mensaje.";
            });
    } else {
        // clean textarea when change status
        messageBox.value = '';
    }
});
});
</script>


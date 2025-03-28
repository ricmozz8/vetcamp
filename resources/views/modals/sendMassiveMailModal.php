<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="/mail" method="POST" id="massive-email-form">
                <div class="form-group">
                    <label for="user_type">Por estado</label>
                    <select required name="user_type" id="select-type">
                        <option value="approved">Aceptados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="applicants">Solicitantes</option>
                        <option value="all">Todos</option>
                    </select>
                </div>

                <!-- Generate the text areas with their status -->
                <?php foreach ($messages as $msg): ?>
                    <?php $estado = $msg->category; ?>
                    <textarea name="message_<?php echo $estado; ?>" id="message-<?php echo $estado; ?>" 
                              placeholder="Introduce un mensaje aquí..." 
                              class="message-textarea" style="display: none;"><?php echo htmlspecialchars($msg->content); ?></textarea>
                <?php endforeach; ?>

                <!-- Default text areas -->
                <textarea required name="message" id="message-text" placeholder="Introduce un mensaje aquí..."></textarea>
                
                <div class="form-group flex-min">
                    <input type="checkbox" id="predefined-message" name="predefined">
                    <label for="predefined-message">Mensaje predefinido</label>
                </div>

                <div class="modal-actions">
                    <a href="#" onclick="closeModal('massiveEmailModal')" class="main-action-bright">Cancelar</a>
                    <button type="submit" class="main-action-bright primary"><i class="fas fa-paper-plane"></i> Enviar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let checkbox = document.getElementById('predefined-message');
    let messageBox = document.getElementById('message-text');
    let selectType = document.getElementById('select-type');
    let form = document.getElementById('massive-email-form');
    let predefinedMessages = document.querySelectorAll('.message-textarea');

    function toggleMessage() {
        let selectedValue = selectType.value;

        // Hidden textarea with predefinedMessages
        predefinedMessages.forEach(textarea => {
            textarea.style.display = 'none';
        });

        let predefinedMessage = document.getElementById('message-' + selectedValue);
        let hasPredefinedMessage = predefinedMessage !== null;

        if (hasPredefinedMessage) {
            checkbox.parentElement.style.display = 'flex'; // If predefinedMessages
        } else {
            checkbox.parentElement.style.display = 'none'; 
            checkbox.checked = false; 
        }

        // uncheck and clean 
        if (hasPredefinedMessage) {
            checkbox.checked = false;
            messageBox.value = ''; 
        } else {
            messageBox.value = ''; 
        }
    }

    checkbox.addEventListener('change', function() {
        let selectedValue = selectType.value;
        let predefinedMessage = document.getElementById('message-' + selectedValue);

        if (checkbox.checked && predefinedMessage) {
            // Copy the text a default text areas
            messageBox.value = predefinedMessage.value; 
        } else {
            messageBox.value = '';
        }
    });

    selectType.addEventListener('change', toggleMessage);

    toggleMessage();
});

</script>

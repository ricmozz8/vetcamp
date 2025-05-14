<!-- genericPopup (modal) -->
<div id="editMessageAll" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('editMessageAll')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="las la-envelope"></i>
            Editar mensaje predeterminado para todos
        </h2>
        
        <form method="post" action="settings/e/all" style="width: 100%;">
            <!-- Message input area -->
            <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= isset($messages['all']['content']) ? $messages['all']['content'] : '' ?></textarea>
            <input name="id" type="hidden" value="<?= isset($messages['all']['id']) ? $messages['all']['id'] : '' ?>">
            <input type="hidden" name="category" value="all">
            <!-- Send button -->
            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('editMessageAll')">Cancelar</a>
                <button class="primary main-action-bright" onclick="closeModal('editMessageAll')"><i class="las la-envelope"> </i>Enviar</button>
            </div>
        </form>
    </div>
</div>
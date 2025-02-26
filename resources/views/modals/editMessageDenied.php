<!-- Main popup container with the form -->
<div id="editMessageDenied" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('editMessageDenied')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="las la-envelope"></i>
            Editar mensaje predeterminado para denegados
        </h2>
        
        <form action="settings/e/rejected" method="POST">
    
            <div class="form-group">
                <textarea name="content" id="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['denied']['content'] ?></textarea>
            </div>

            <input name="id" type="hidden" value="<?= $messages['denied']['id'] ?>">

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('editMessageDenied')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> 
                    <i class="las la-envelope"></i> 
                    Enviar
                </button>
            </div>
          
        </form>
    </div>
</div>
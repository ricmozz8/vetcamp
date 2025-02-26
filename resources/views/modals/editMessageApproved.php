<!-- ELIMINE LOS COMENTARIOS AL IMPLEMENTAR -->
<div id="editMessageApproved" class="modal">
    <div class="modal-content">
    
        <!-- Botón de cerrar -->
        <span class="close-button" onclick="closeModal('editMessageApproved')">
          <i class="fas fa-times"></i>
        </span>
       <!-- Título de la ventana -->
        <h2>
            <i class="fas fa-envelope"></i>
            Editar mensaje predeterminado para aceptados
        </h2>
        
        <form action="settings/e/approved" method="POST">
    
            <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['approved']['content'] ?></textarea>
            <input name="id" type="hidden" value="<?= $messages['approved']['id'] ?>">
            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('editMessageApproved')">Cancelar</a>
                <button class="primary main-action-bright" onclick="closeModal('editMessageApproved')"><i class="las la-envelope"> </i>Enviar</button>
            </div>
          
        </form>
    </div>
</div>
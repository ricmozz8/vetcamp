<!-- Main popup container with the form -->
<div class="message-popup" id="editMessageDenied" style="display: none">
    <!-- Close button in the top-right corner -->
    <!-- <img src="https://img.icons8.com/?size=100&id=71200&format=png&color=1A1A1A" alt="Close" class="close-icon" id="closePopup"> -->
    <a href="#" class="plain-action" id="closePopup" onclick="closeModal('editMessageDenied')"><i class="las la-times"></i></a>

    <!-- Popup title -->
    <h2 class="message-title">Editar mensaje predeterminado para denegados</h2>

    <!-- Form area -->
    <form method="post" action="settings/e/rejected" style="width: 100%;">
        <!-- Message input area -->
        <textarea name="content" class="message-textarea" placeholder="Escriba su mensaje aquí..." aria-label="Message input"><?= $messages['denied']['content'] ?></textarea>
        <input name="id" type="hidden" value="<?= $messages['denied']['id'] ?>">
        <!-- Send button -->
        <button class="primary main-action-bright" onclick="closeModal('editMessageDenied')"><i class="las la-envelope"> </i>Guardar</button>
    </form>
</div>
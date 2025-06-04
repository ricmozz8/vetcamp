<div id="videoChoiceModal" class="modal" style="display:none;">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('videoChoiceModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-video"></i>
            Seleccionar método de envío
        </h2>
        <div class="modal-actions">
            <label for="video_essay" class="main-action-bright primary" onclick="closeModal('videoChoiceModal')">
                <i class="fas fa-file-upload"></i> Subir archivo
            </label>
            <a href="#" class="main-action-bright" onclick="closeModal('videoChoiceModal'); openModal('videoLinkModal');">
                <i class="fas fa-link"></i> Usar enlace
            </a>
        </div>
    </div>
</div>

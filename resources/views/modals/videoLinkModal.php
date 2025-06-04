<div id="videoLinkModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('videoLinkModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-link"></i>
            Añadir enlace de video
        </h2>
        <form action="/apply/application/video-link" method="POST">
            <div class="form-group">
                <label for="video_link">URL del video</label>
                <input type="url" name="video_essay_link" id="video_link" value="<?= $application->video_essay_link ?? '' ?>" required>
            </div>
            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('videoLinkModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"><i class="fas fa-save"></i> Guardar</button>
            </div>
        </form>
    </div>
</div>

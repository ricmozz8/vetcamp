<div id="sendSessionMailModal-<?= $modal_session_class ?? '' ?>" class="modal">
    <div class="modal-content">
        <form action="/admin/sm" method="POST" class="simple-form">
            <span class="close-button" onclick="closeModal('sendSessionMailModal-<?= $modal_session_class ?? '' ?>')"><i class="fas fa-times"></i></span>
            <h2 class="flex-min"><i class="fas fa-paper-plane"></i>Enviar mensaje a <?= $session['title'] ?></h2>

            <div>
                <textarea required name="message" placeholder="Introduce un mensaje aquí..."></textarea>
                <input type="hidden" value="<?= $session['id'] ?>" name="session_id">
                <div class="modal-actions">

                    <button type="submit" class="main-action-bright primary"><i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
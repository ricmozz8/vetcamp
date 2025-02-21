<div id="singleMessageModal" class="modal">
    <div class="modal-content">
        <form action="/admin/m" method="POST" class="simple-form">
            <span class="close-button" onclick="closeModal('singleMessageModal')"><i class="fas fa-times"></i></span>
            <h2 class="flex-min"><i class="fas fa-paper-plane"></i>Enviar mensaje</h2>

            <div>

                <p class="flex-nosp">
                    <strong>Enviando a:</strong>
                    <a href="mailto:<?= $user->email ?>">
                        <?= $user->email ?></a></p>


                <textarea required name="message" placeholder="Introduce un mensaje aquí..."></textarea>
                <input type="hidden" value="<?= $user->user_id ?>" name="user_id">
                <div class="modal-actions">
                    <button type="submit" class="main-action-bright primary"><i class="fas fa-paper-plane"></i> Enviar
                    </button>
                </div>
        </form>
    </div>
</div>
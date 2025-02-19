<div id="messageModal" class="modal">
    <div class="modal-content">
        <form action="/mail/user" method="POST">
            <span class="close-button" onclick="closeModal('messageModal')"><i class="fas fa-times"></i></span>
            <h2>Enviar mensaje</h2>
            <div class="modal-details">
                <div>
                    <strong>Enviando a:</strong>
                    <p><?= $user->first_name . " " . $user->last_name ?></p>
                    <p><a class="no-deco-action" href="mailto:ddorwart@icloud.com"><?= $user->email ?></a></p>
                </div>
                <div class="status-badge">
                    <strong>Estado de la solicitud:</strong>
                    <p><?= $application->status ?></p>
                </div>
            </div>
            <input type="hidden" name="user_id" value=<?=$application->user_id ?> >
            <textarea required name="message" placeholder="Introduce un mensaje aquí..."></textarea>
            <button class="main-action-bright secondary"><i class="fas fa-paper-plane"></i> Enviar</button>
        </form>
    </div>
</div>
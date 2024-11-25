<div id="messageModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('messageModal')"><i class="las la-times"></i></span>
        <h2>Enviar mensaje</h2>
        <div class="modal-details">
            <div>
                <strong>Enviando a:</strong>
                <p><?= $user->first_name . " " . $user->last_name ?></p>
                <p><a class="no-deco-action" href="mailto:ddorwart@icloud.com"><?= $user->email ?></a></p>
            </div>
            <div class="status-info">
                <strong>Estado de la solicitud:</strong>
                <p><?= $application->status ?></p>
            </div>
        </div>
        <textarea placeholder="Introduce un mensaje aquí..."></textarea>
        <button class="main-action-bright secondary"><i class="las la-paper-plane"></i> Enviar</button>
    </div>
</div>
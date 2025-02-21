<div id="confirmRemoveApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmRemoveApplicationModal')"><i class="fas fa-times"></i></span>
        <h2><i class="fas fa-exclamation-circle"></i> ¿Quieres rescindir tu solicitud?</h2>



        <div class="modal-details">
            <p>Tendrás que volver a someter tus datos y documentos nuevamente. Utiliza esta acción si ya no deseas participar
            en el campamento, o deseas rellenar la información nuevamente.</p>
        </div>
        <form action="/profile/a/rescind" method="POST">
            <div class="form-group">
                <label for="confirmation-text">Escribe 'borrar mi solicitud' para confirmar la acción</label>
                <input type="text" required name="confirmation_text" id="confirmation-text" placeholder="Escribe 'borrar mi solicitud'"/>

            </div>
            <div class="modal-actions">
                <button type="submit" class="main-action-bright danger"><i class="fas fa-trash"></i> Borrar</button>
            </div>
        </form>
    </div>
</div>
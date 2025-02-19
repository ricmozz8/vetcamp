<div id="confirmSubmitApplicationModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('confirmSubmitApplicationModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-question-circle"></i>
        <h2>¿Estás seguro de que quieres enviar la solicitud?</h2>
        <p>Tu solicitud será evaluada con la información proporcionada.</p>
        <textarea name="extra_info" id="extra_info" placeholder="Introduce alguna información adicional que quieras compartir, por ejemplo si sufres alguna condición medica o alergias que los coordinadores del campamento deban saber..."><?= $application->extra_notes ?></textarea>
        <label class="mini-label" for="extra_info">Esta información es opcional, puedes dejarlo en blanco.</label>
        <div class="modal-actions">
            <a href="#" class="main-action-bright" onclick="closeModal('confirmSubmitApplicationModal')">Cancelar</a>
            <button type="submit" class="main-action-bright gradiented">
                <i class="fas fa-paper-plane"></i>
                Enviar</button>
        </div>
    </div>
</div>
<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="/mail" method="POST">
                <div class="form-group">
                    <label for="user_type">Por estado</label>
                    <select required name="user_type" id="select-type">
                        <option value="approved">Aceptados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="applicants">Solicitantes</option>
                        <option value="interested">Interesados</option>
                        <option value="all">Todos</option>
                    </select>
                </div>

                <textarea required name="message" placeholder="Introduce un mensaje aquí..."></textarea>

        </div>

        <div class="modal-actions">
            <a href="#" onclick="closeModal('massiveEmailModal')" class="main-action-bright">Cancelar</a>
            <button type="submit" class="main-action-bright primary"><i class="fas fa-paper-plane"></i> Enviar</button>
        </div>
        </form>
    </div>
</div>
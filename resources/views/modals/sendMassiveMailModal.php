<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="fas fa-times"></i></span>
        <i class="fas fa-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="/mail" method="POST">
                <div class="modal-header-flex">
                    <select required name="type" id="select-type">
                        <option value="approved">Aprobados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="all">Todos</option>
                    </select>
                    <label for="predef-msg">Utilizar mensaje predefinido</label>
                    <input type="checkbox" name="predef-msg" id="">
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
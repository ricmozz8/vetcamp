<div id="massiveEmailModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('massiveEmailModal')"><i class="las la-times"></i></span>
        <i class="las la-envelope"></i>
        <h2>Enviar mensaje masivo</h2>
        <div class="modal-details">
            <form action="">
                <div class="modal-header-flex">
                    <select name="type" id="select-type">
                        <option value="approved">Aprobados</option>
                        <option value="denied">Rechazados</option>
                        <option value="waitlist">En lista de espera</option>
                        <option value="all">Todos</option>
                    </select>
                    <label for="predef-msg">Utilizar mensaje predefinido</label>
                    <input type="checkbox" name="predef-msg" id="">
                </div>

                <textarea name="message" placeholder="Introduce un mensaje aquí..."></textarea>

        </div>

        <button class="main-action-bright primary"><i class="las la-paper-plane"></i> Enviar</button>
        </form>
    </div>
</div>
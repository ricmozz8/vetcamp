<div id="phoneNumberEditModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('phoneNumberEditModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-phone"></i>
            Editar teléfono
        </h2>


        <form action="/profile/phone/update" method="POST">
            <div class="form-group">
                <label for="phone_number">Número de teléfono</label>
                <input type="text" name="phone_number" id="phone_number" value="<?= Auth::user()->phone_number ?? '' ?>" required>
            </div>

            <div class="modal-actions">
                <a class="main-action-bright" onclick="closeModal('phoneNumberEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright primary"> <i class="fas fa-save"></i> Guardar</button>

            </div>
        </form>


    </div>
</div>
<div id="userProfileEditModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('userProfileEditModal')"><i class="fas fa-times"></i></span>
        <h2>
            <i class="fas fa-user"></i>
            Editar perfil
        </h2>


        <form action="/profile/update" method="POST">

            <input type="hidden" name="user_id" value="<?= Auth::user()->__get('user_id') ?? '' ?>">
            <div class="form-group">
                <label for="name">Nombre</label>
                <input type="text" name="first_name" id="first_name" value="<?= Auth::user()->first_name ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input type="text" name="last_name" id="last_name" value="<?= Auth::user()->last_name ?? '' ?>" required>
            </div>

            <div class="form-group">
                <label for="email">Correo</label>
                <input type="email" name="email" id="email" value="<?= Auth::user()->email ?? '' ?>" required>
            </div>

            <div class="modal-actions">

                <a class="main-action-bright" onclick="closeModal('userProfileEditModal')">Cancelar</a>
                <button type="submit" class="main-action-bright gradiented"> <i class="fas fa-save"></i> Guardar</button>

            </div>
        </form>


    </div>
</div>
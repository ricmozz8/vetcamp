<div id="addAdminModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('addAdminModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-user"></i><br>
            Crear nuevo usuario de administrador</h2>

        <p>Este usuario podrá acceder al panel de administración</p>
        <br>
    
        <form class="w-full" action="/admin/create" method="POST">
           

            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input class="session-edit-input w-full" type="text" name="first_name" placeholder="Nombre" required>
            </div>

            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input class="session-edit-input w-full" type="text" name="last_name" placeholder="Apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input class="session-edit-input w-full" type="email" name="email" placeholder="Correo" required>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <input class="session-edit-input w-full" type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Confirmar contraseña</label>
                <input class="session-edit-input w-full" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>
            <div class="modal-actions">
            <div class="w-fit">
                <input type="checkbox" name="notify">
                <label for="notify">Notificar al correo</label>
            </div>
            <button class="main-action-bright"><i class="las la-user"></i> Crear</button>
            </div>
            
        </form>
    </div>
</div>
<div id="createAdminModal" class="modal">
    <div class="modal-content">
        <span class="close-button" onclick="closeModal('createAdminModal')"><i class="las la-times"></i></span>
        <h2>
            <i class="las la-user"></i><br>
            Crear nuevo usuario de administrador
        </h2>

        <p>Este usuario podrá acceder al panel de administración</p>
        <br>

        <form class="fas fa-" action="/admin/create" method="POST">


            <div class="form-group">
                <label for="first_name">Nombre</label>
                <input class="" type="text" name="first_name" placeholder="Nombre" required>
            </div>

            <div class="form-group">
                <label for="last_name">Apellido</label>
                <input class="" type="text" name="last_name" placeholder="Apellido" required>
            </div>
            <div class="form-group">
                <label for="email">Correo</label>
                <input class="" type="email" name="email" placeholder="Correo" required>
            </div>

            <div class="form-group">
                <div class="flex-min">
                    <label for="password">Contraseña</label>
                    <span class="password-toggle" onclick="togglePassword()">
                         <i class="fas fa-eye"></i>
                    </span>
                </div>

                <input class="" id="password" type="password" name="password" placeholder="Contraseña" required>
            </div>

            <div class="form-group">
                <div class="flex-min">
                    <label for="password">Confirmar Contraseña</label>
                    <span class="password-toggle password-toggle-c" onclick="togglePassword('password-confirmation', 'password-toggle-c')">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>
                <input class="" id="password-confirmation" type="password" name="password_confirmation" placeholder="Confirmar contraseña" required>
            </div>
            <div class="modal-actions">
                <div class="flex-min">
                    <input type="checkbox" name="notify">
                    <label for="notify">Notificar al correo</label>
                </div>
                <button type="submit" class="main-action-bright primary"><i class="las la-user"></i> Crear</button>
            </div>

        </form>
    </div>

</div>
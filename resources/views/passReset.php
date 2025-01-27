<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>


            <?php require_once 'partials/genericNavbarNoAuth.php'; ?>

            <!-- Password reset form -->
            <form action="/passreset" method="POST" class="auth-form">
                <h1> <i class="las la-key"></i> Restablece tu contraseña</h1>

                <!-- New password input -->
                <div class="field-wrapper">

                    <div class="mini-flex-label">
                        <label for="password">Nueva Contraseña</label>
                        <span class="password-toggle" onclick="togglePasswords()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <input type="password" id="password" name="password" required class="" placeholder="Ingrese la nueva contraseña">


                </div>

                <!-- Confirm password input -->
                <div class="field-wrapper">

                    <div class="mini-flex-label">
                        <label for="confirm_password">Confirma la nueva contraseña</label>
                        <span class="password-toggle" onclick="togglePasswords()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <input type="password" name="confirm_password" id="confirm_password" class="input-field input-confirm-password" placeholder="Ingrese la contraseña de nuevo" required>
                    <input type="hidden" name="token" value="<?= $reset_token ?>">

                </div>

                <!-- Submit button -->
                <div class="form-main-actions">
                    <button type="submit" class="main-action-bright gradiented">
                        Restablecer
                    </button>
                </div>
            </form>
        </div>

    <!-- Password Visibility Toggle Script -->
    <script src="resources/views/js/passVisibility.js"></script>

</body>

</html>
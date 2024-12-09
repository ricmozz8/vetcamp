<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main password reset container -->
        <div class="pass-reset">

        <div class="content-left">

            <!-- Logo with link to home page -->
            <a class="logo" href="/"><img src="resources/assets/logo/SVG/vetcamp_full_hoz_b.svg" alt="Vetcamp" class="logo"></a>

            <!-- Password reset form -->
            <form action="/passreset" method="POST">
                <div class="page-title">Restablece tu contraseña</div>

                <!-- New password input -->
                <div class="field-wrapper">
                    <div class="password-container">
                        <label for="password" class="text-wrapper-2">Nueva Contraseña</label>
                        <input type="password" id="password" name="password" required class="input-field input-password" placeholder="Ingrese la nueva contraseña">
                        <span class="password-toggle" onclick="togglePasswords()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <!-- Confirm password input -->
                <div class="field-wrapper">
                    <div class="password-container">
                        <label for="confirm_password" class="text-wrapper-3">Confirma la nueva contraseña</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="input-field input-confirm-password" placeholder="Ingrese la contraseña de nuevo" required>
                        <span class="password-toggle" onclick="togglePasswords()">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>

                <!-- Submit button -->
                <div class="mainbutton">
                    <button type="submit" class="main-action-bright">
                        <div class="secondary-action">Restablecer</div>
                    </button>
                </div>
            </form>
        </div>
        </div>
        
        <!-- Right Side Image Container -->
        <?php require_once('partials/authPagesRightSide.php'); ?>


    </div>

    <!-- Password Visibility Toggle Script -->
    <script src="resources/views/js/passVisibility.js"></script>

</body>
</html>

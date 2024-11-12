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
            <form action="login.php" method="POST">

            <div class="page-title">Restablece tu contraseña</div>

                <div class="input-group">
                     <div class="field-wrapper">
                        <div class="password-container">
                            <!-- New password input -->
                            <label for="email" class="text-wrapper-2">Nueva Contraseña</label>
                            <input type="password"
                                   id="password"
                                   name="password"
                                   required
                                   class="input-field input-password"
                                   placeholder="Ingrese la nueva contraseña"
                                   required>
                                       <span class="password-toggle" onclick="togglePasswords()">
                                          <i class="fas fa-eye"></i>
                                       </span>
                        </div>
                     </div>

                     <div class="field-wrapper">
                        <div class="password-container">
                                <!-- Confirm password input -->
                                <label for="password" class="text-wrapper-3">Confirma la nueva contraseña</label>
                                <input type="password"
                                       name="confirm_password"
                                       id="confirm_password"
                                       class="input-field input-confirm-password"
                                       placeholder="Ingrese la contraseña de nuevo"
                                       required>
                                           <span class="password-toggle" onclick="togglePasswords()">
                                              <i class="fas fa-eye"></i>
                                           </span>
                        </div>
                     </div>
                </div>

                <!-- Submit button with hover effect -->
                <div class="mainbutton">
                    <button type="submit" class="main-action-bright">
                            <div class="secondary-action">restablecer</div>
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Right Side Image Container -->
        <?php require_once('partials/authPagesRightSide.php'); ?>


    </div>

    <!-- Password Visibility Toggle Script -->
    <script src="resources/views/js/passVisibility.js"></script>

</body>
</html>
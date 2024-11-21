<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main sign-up container -->
    <div class="sign-up">

        <div class="content-left">

                <!-- Logo with link to home page -->
                <a class="logo" href="/"><img src="resources/assets/logo/SVG/vetcamp_full_hoz_b.svg" alt="Vetcamp" class="logo"></a>

                <!-- Sign-up form -->
                <form action="/register/new" method="POST"> <!-- Update -->
                    <!-- Page Title -->
                    <div class="page-title">Regístrate</div>
                    <?php 
                        if (isset($error))
                            echo '<div class="alert alert-danger">' . $error . '</div>';
                    ?>

                        <div class="input-group">

                            <div class="name-phone-wrapper">
                                <div class="field-wrapper">
                                    <!-- Name input field -->
                                    <div class="text-wrapper-3">Nombre</div>
                                    <input type="text"
                                           name="first_name"
                                           id="nombre"
                                           class="input-field input-name"
                                           placeholder="Juan"
                                           required>
                                </div>
                                <div class="field-wrapper">
                                    <!-- Name input field -->
                                    <div class="text-wrapper-3">Apellidos</div>
                                    <input type="text"
                                           name="last_name"
                                           id="nombre"
                                           class="input-field input-name"
                                           placeholder="del Pueblo"
                                           required>
                                </div>
                                <div class="field-wrapper">
                                    <!-- Phone input field -->
                                    <div class="text-wrapper-4">Teléfono</div>
                                    <input type="tel"
                                           name="phone_number"
                                           id="telefono"
                                           class="input-field input-phone"
                                           placeholder="(000)-000-0000"
                                           required>
                                </div>
                            </div>

                         
                            <div class="field-wrapper">
                                <!-- Email input field -->
                                <div class="text-wrapper-2">Correo</div>
                                <input type="email"
                                       name="email"
                                       id="correo"
                                       class="input-field input-email"
                                       placeholder="juan.delpueblo@upr.edu"
                                       required>
                            </div>

                            <div class="field-wrapper">
                                <!-- Password input field -->
                                <div class="text-wrapper-5">Cree una contraseña</div>
                                    <div class="password-container"> <!-- To be fixed on both pass fields -->
                                        <input type="password"
                                               name="password"
                                               id="password"
                                               class="input-field input-password"
                                               placeholder="Ingrese la contraseña"
                                               required>
                                               <span class="password-toggle" onclick="togglePasswords()">
                                                  <i class="fas fa-eye"></i>
                                               </span>
                                    </div>
                            </div>

                            <div class="field-wrapper">
                                <!-- Confirm password input field -->
                                <div class="text-wrapper-6">Confirme Contraseña</div>
                                    <div class="password-container">
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

                    <div class="actions">
                           <!-- Submit button -->
                           <div class="mainbutton">
                                <button type="submit" class="main-action-bright">
                                     <div class="secondary-action">regístrate</div>
                                </button>
                           </div>

                        <!-- Login link -->
                        <a class="secondary-action-2" href="/login" >ya tienes cuenta?</a>
                    </div>
                </form>
        </div>

        <!-- Right Side Image Container -->
        <?php require_once('partials/authPagesRightSide.php'); ?>

    </div>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePasswords() {
          const passwordField = document.getElementById('password');
          const confirmPasswordField = document.getElementById('confirm_password');
          const toggleIcons = document.querySelectorAll('.password-toggle i');

          if (passwordField.type === 'password') {
            passwordField.type = 'text';
            confirmPasswordField.type = 'text';
            toggleIcons.forEach(icon => icon.classList.replace('fa-eye', 'fa-eye-slash'));
          } else {
            passwordField.type = 'password';
            confirmPasswordField.type = 'password';
            toggleIcons.forEach(icon => icon.classList.replace('fa-eye-slash', 'fa-eye'));
          }
        }
    </script>

</body>
</html>
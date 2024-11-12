<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main login Container -->
    <div class="login">

        <div class="content-left">

            <!-- Logo with link to home page -->
            <a class="logo" href="/"><img src="resources/assets/logo/SVG/vetcamp_full_hoz_b.svg" alt="Vetcamp" class="logo"></a>

            <!-- Login Form -->
            <form action="/login/auth" method="POST"> <!-- Update -->
                <!-- Page Title -->
                <div class="page-title">Inicia Sesión</div>

                <div class="input-group">

                    <div class="field-wrapper">
                        <label for="email" class="text-wrapper-2">Correo</label>
                        <input type="email" id="email" name="email" required class="input-field input-email" placeholder="juan.delpueblo@upr.edu">
                    </div>

                    <div class="field-wrapper">
                        <label for="password" class="text-wrapper-2">Contraseña</label>
                        <div class="password-container">
                            <input type="password" id="password" name="password" required class="input-field input-password" placeholder="Ingrese su contraseña">
                            <span class="password-toggle" onclick="togglePassword()" style="right: 8%">
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>
                    </div>

                </div>

                <div class="actions">
                    <!-- Submit Button -->
                    <div class="mainbutton">
                        <button type="submit" class="main-action-bright">
                                <div class="secondary-action">entrar</div>
                        </button>
                    </div>

                    <a href="/register" class="signup-link">no tienes cuenta?</a>
                </div>
                <a href="/forgotPass" class="pass-reset-link">olvidé mi contraseña</a>
            </form>
        </div>

        <!-- Right Side Image Container -->
        <?php require_once('partials/authPagesRightSide.php'); ?>

    </div>

    <!-- Password Visibility Toggle Script -->
    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.querySelector('.password-toggle i');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                toggleIcon.classList.remove('fa-eye');
                toggleIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                toggleIcon.classList.remove('fa-eye-slash');
                toggleIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
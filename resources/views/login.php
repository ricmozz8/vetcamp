<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main login Container -->
    <div class="login">

        <div class="content-left">

            <?php require __DIR__ . '/partials/genericNavbarNoAuth.php'; ?>

            <!-- Login Form -->
            <form action="/login" method="POST" class="auth-form">
                <!-- Page Title -->
                <h1>
                    <i class="las la-user"></i>
                    Inicia sesión

                </h1>
                <div class="input-group">
                    <div class="field-wrapper">
                        <label for="email" class="text-wrapper-2">Correo</label>
                        <input autocomplete="off" type="email" id="email" name="email" required class="input-field input-email" placeholder="juan.delpueblo@upr.edu">
                    </div>
                    <div class="field-wrapper">
                        <div class="mini-flex-label">
                            <label for="password" class="text-wrapper-2">Contraseña</label>
                            <span class="password-toggle" onclick="togglePassword()">
                                Alternar mostrar <i class="fas fa-eye"></i>
                            </span>
                        </div>


                        <input autocomplete="off" type="password" id="password" name="password" required class="input-field input-password" placeholder="Ingrese su contraseña">

                    </div>

                    <?php
                    if (isset($_POST['error'])) {
                        echo '<div class="error-message">' . $_POST['error'] . '</div>';
                    }
                    ?>
                </div>
                <div class="form-main-actions">
                    <a href="/register" class="main-action-bright no-deco-action">¿no tienes cuenta?</a>
                    <button type="submit" class="main-action-bright gradiented">
                        Iniciar Sesión
                    </button>
                </div>
                <hr>

                <div class="splitted-actions">
                    <a href="/forgotPass" class="main-action-bright no-deco-action">olvidé mi contraseña</a>

                </div>
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
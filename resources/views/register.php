<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main sign-up container -->
    <div class="">

        <div class="content-left">

            <?php require_once('partials/genericNavbarNoAuth.php'); ?>

            <!-- Sign-up form -->
            <form action="/register/new" method="POST" class="auth-form"> <!-- Update -->
                <!-- Page Title -->
                <h1>
                    <i class="las la-arrow-right"></i>
                    Regístrate
                </h1>
                <?php
                if (isset($error))
                    echo '<div class="alert alert-danger">' . $error . '</div>';
                ?>

                <div class="input-group">


                    <div class="field-wrapper">
                        <!-- Name input field -->
                        <label  for="first_name">Nombre</label>
                        <input type="text"
                            name="first_name"
                            id="nombre"
                            class="input-field input-name"
                            placeholder="Juan"
                            required>
                    </div>
                    <div class="field-wrapper">
                        <!-- Name input field -->
                        <label for ="last_name">Apellidos</label>
                        <input type="text"
                            name="last_name"
                            id="nombre"
                            class="input-field input-name"
                            placeholder="del Pueblo"
                            required>
                    </div>
                    <div class="field-wrapper">
                        <!-- Phone input field -->
                        <label for="phone_number">Teléfono</label>
                        <input type="number"
                            name="phone_number"
                            id="telefono"
                            class="input-field input-phone"
                            placeholder="(000)-000-0000"
                            required>
                    </div>



                    <div class="field-wrapper">
                        <!-- Email input field -->
                        <label for="email">Correo</label>
                        <input type="email"
                            name="email"
                            id="correo"
                            class="input-field input-email"
                            placeholder="juan.delpueblo@upr.edu"
                            required>
                    </div>

                    <div class="field-wrapper">
                        <!-- Password input field -->
                        <div class="mini-flex-label">
                            
                            <label for="password">Contraseña</label>

                            <span class="password-toggle" onclick="togglePasswords()">
                                Alternar Mostrar<i class="fas fa-eye"></i>
                            </span>
                        </div>

                        <input type="password"
                            name="password"
                            id="password"
                            class="input-field input-password"
                            placeholder="Ingrese la contraseña"
                            required>


                    </div>

                    <div class="field-wrapper">
                        <!-- Confirm password input field -->
                        <div class="mini-flex-label">
                            <label for="confirm_password">Confirmar Contraseña</label>
                            <span class="password-toggle" onclick="togglePasswords()">
                                Alternar Mostrar
                                <i class="fas fa-eye"></i>
                            </span>
                        </div>

                        <input type="password"
                            name="confirm_password"
                            id="confirm_password"
                            class="input-field input-confirm-password"
                            placeholder="Ingrese la contraseña de nuevo"
                            required>


                        <!-- Other information this user -->
                        <div class="age-check-input">
                            <label for="age" class="size">Age: </label>
                            <input type="text" id="age" name="age" class="age-check-input">
                        </div>
                    </div>
                </div>

                <div class="form-main-actions">
                    <!-- Submit button -->
                    <div class="form-main-action">
                        <button type="submit" class="main-action-bright gradiented">
                            Regístrate
                            <i class="las la-arrow-right"></i>
                        </button>
                    </div>

                    <!-- Login link -->
                    <a class="main-action-bright no-deco-action" href="/login">ya tienes cuenta?</a>
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
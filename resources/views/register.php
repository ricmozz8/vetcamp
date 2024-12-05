<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main sign-up container -->
    <div class="">

        <div class="content-left">

            <!-- Logo with link to home page -->
            <a class="logo" href="/"><?php require_once('partials/applicationLogo.php'); ?></a>

            <!-- Sign-up form -->
            <form action="/register/new" method="POST"> <!-- Update -->
                <!-- Page Title -->
                <h2 class="page-title">Regístrate</h2>
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
                        <div class="flex">Cree una contraseña

                            <span class="password-toggle" onclick="togglePasswords()">
                                Alternar Mostrar<i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="password-container"> <!-- To be fixed on both pass fields -->
                            <input type="password"
                                name="password"
                                id="password"
                                class="input-field input-password"
                                placeholder="Ingrese la contraseña"
                                required>

                        </div>
                    </div>

                    <div class="field-wrapper">
                        <!-- Confirm password input field -->
                        <div class="flex">Confirme Contraseña
                            <span class="password-toggle" onclick="togglePasswords()">
                                Alternar Mostrar<i class="fas fa-eye"></i>
                            </span>
                        </div>
                        <div class="password-container">
                            <input type="password"
                                name="confirm_password"
                                id="confirm_password"
                                class="input-field input-confirm-password"
                                placeholder="Ingrese la contraseña de nuevo"
                                required>

                        </div>
                        <!-- Other information this user -->
                        <div class="age-check-input">
                            <label for="age" class="size">Age: </label>
                            <input type="text" id="age" name="age" class="age-check-input">
                        </div>
                    </div>
                </div>

                <div class="splitted-actions">
                    <!-- Submit button -->
                    <div class="mainbutton">
                        <button type="submit" class="main-action-bright">
                            regístrate
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
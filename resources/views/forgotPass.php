<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main container for forgot password page -->
    <div class="forgot-pass">

        <div class="content-left">

           <!-- Logo with link to home page -->
           <a class="logo" href="/"><img src="resources/assets/logo/PNG/vetcamp_full_hoz_b.png" alt="Vetcamp" class="logo"></a>

            <!-- Password reset form -->
            <form action="login.php" method="POST">

                    <div class="input-group">

                        <div class="field-wrapper">
                            <!-- Back button to return to login page -->
                            <a href="/login" class="no-deco-action">
                                <img src="resources/assets/back-arrow.svg" alt="Back Button" class="back-button"></div>
                            </a>
                        </div>

                        <!-- Page Title -->
                        <div class="page-title">¿Olvidaste tu contraseña?</div>

                        <div class="field-wrapper">
                            <label for="email" class="text-wrapper-2">Correo</label>
                            <input type="email"
                                   id="email"
                                   name="email"
                                   required
                                   class="input-field input-email"
                                   placeholder="juan.delpueblo@upr.edu">
                        </div>

                        <div class="field-wrapper">
                            <!-- Instruction text -->
                            <div class="text-wrapper-3">Escribe tu correo electrónico para restaurar <br> tu contraseña</div>
                        </div>

                    </div>

                        <div class="actions">
                            <!-- Submit button -->
                            <button type="submit" class="mainbutton">
                                <div class="overlap-group">
                                    <div class="button-rectangle"></div>
                                    <div class="secondary-action">restablecer</div>
                                </div>
                            </button>
                        </div>
            </form>
        </div>

    <!-- Right Side Image Container -->
    <?php require_once('partials/authPagesRIghtSide.php'); ?>

    </div>
</body>
</html>
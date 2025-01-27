<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main container for forgot password page -->
    <div class="forgot-pass">

        <?php require_once 'partials/genericNavbarNoAuth.php'; ?>

        <form action="/forgotpass" method="POST" class="auth-form">

            <h1>¿Olvidaste tu contraseña? <i class="las la-key"></i></h1>
            <div class="input-group">
                <div class="field-wrapper">
                    <label for="email">Introduce tu Correo</label>
                    <input type="email" id="email" name="email" required placeholder="juan.delpueblo@upr.edu">
                </div>
            </div>
            <div class="form-main-actions">
                <button type="submit" class="main-action-bright gradiented">
                    Enviar
                </button>
            </div>
        </form>

    </div>
</body>

</html>
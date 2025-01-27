<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>


<body>
    <?php require_once 'partials/genericNavbarNoAuth.php'; ?>
    <form method="POST" action="/restablish" class="auth-form">
        <h1>Restablecer contraseña <i class="las la-key"></i></h1>
        <p>Se ha enviado un código de restablecimiento a tu correo electrónico (<?= $reset_email ?>).</p>
        <div class="input-group">
            <div class="field-wrapper">
                <label for="email">Introduce el código</label>
                <input type="text" name="reset-code" id="reset-code">
            </div>
        </div>
        <button type="submit" class="main-action-bright gradiented">
            Enviar <i class="las la-arrow-right"></i>
        </button>

    </form>
</body>
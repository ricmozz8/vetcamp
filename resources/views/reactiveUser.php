<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>


<body>
    <?php require_once 'partials/genericNavbarNoAuth.php'; ?>
    <form method="POST" action="/reactiveuser" class="auth-form">
        <h1>Reactiva tu cuenta en Vetcamp <i class="las la-key"></i></h1>
        <p>Se ha enviado un código de restablecimiento a tu correo electrónico</p>
        <div class="input-group">
            <div class="field-wrapper">
                <label for="codeOTP">Introduce el código</label>
                <input type="text" name="codeOTP" id="codeOTP" required>
            </div>
        </div>
        <button type="submit" class="main-action-bright gradiented">
            Enviar <i class="las la-arrow-right"></i>
        </button>

    </form>
</body>
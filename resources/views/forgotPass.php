<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main container for forgot password page -->
        <div class="forgot-pass">
            <div class="content-left">
                <a class="logo" href="/">
                <?php require_once('partials/applicationLogo.php'); ?>
                </a>

                <form action="/forgotpass" method="POST">
                    <!-- Back button -->
                    <a href="/" class="main-action-bright">
                        <i class="las la-arrow-left"></i>
                        <p>Atrás</p>
                    </a>
                    <?php if (empty($otpSent)): ?>
                      <h1 class="page-title">¿Olvidaste tu contraseña? </h1>
                        <div class="input-group">
                            <div class="field-wrapper">
                                <label for="email" class="text-wrapper-2">Correo</label>
                                <input type="email" id="email" name="email" required class="input-field input-email" placeholder="juan.delpueblo@upr.edu">
                            </div>
                            <div class="field-wrapper">
                                <div class="text-wrapper-3">Escribe tu correo electrónico.</div>
                            </div>
                        </div>
                    <?php elseif (isset($otpSent) && !$otpValidated): ?>
                        <div class="input-group">
                            <div class="field-wrapper">
                                <label for="otp" class="text-wrapper-2">Código OTP</label>
                                <input type="text" id="otp" name="otp" required class="input-field input-otp" placeholder="Ingrese el código OTP">
                            </div>
                            <div class="field-wrapper">
                                <div class="text-wrapper-3">Ingrese el código OTP enviado a su correo electrónico.</div>
                            </div>
                        </div>
                        <input type="hidden" name="generatedOtp" value="<?php echo htmlspecialchars($generatedOtp); ?>">

                        <!-- Display the OTP on the page for demonstration -->
                        <div class="otp-demo">
                            <strong>Simulated OTP:</strong> <?php echo htmlspecialchars($generatedOtp); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                            <button type="submit" class="main-action-bright">
                                    <?php if (empty($otpSent)): ?>
                                        Enviar
                                    <?php elseif (isset($otpSent) && !$otpValidated): ?>
                                        Validar código
                                    <?php endif; ?>
                            </button>
                </form>
            </div>
        </div>
    <!-- Right Side Image Container -->
    <?php require_once('partials/authPagesRightSide.php'); ?>

    </div>
</body>
</html>

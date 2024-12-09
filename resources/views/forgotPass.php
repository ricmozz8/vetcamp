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

                <?php if (isset($error)): ?>
                    <div class="alert error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <?php if (isset($message)): ?>
                    <div class="alert success"><?php echo htmlspecialchars($message); ?></div>
                <?php endif; ?>

                <form action="/forgotpass" method="POST">
                    <!-- Back button -->
                    <a href="/login" class="no-deco-action">
                                <img src="resources/assets/back-arrow.svg" alt="Back Button" class="back-button">
                    </a>
                    <?php if (empty($otpSent)): ?>
                        <div class="input-group">
                            <div class="field-wrapper">
                                <label for="email" class="text-wrapper-2">Correo</label>
                                <input type="email" id="email" name="email" required class="input-field input-email" placeholder="juan.delpueblo@upr.edu">
                            </div>
                            <div class="field-wrapper">
                                <div class="text-wrapper-3">Escribe tu correo electrónico para recibir un código OTP.</div>
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
                    <?php endif; ?>

                    <div class="actions">
                        <div class="mainbutton">
                            <button type="submit" class="main-action-bright">
                                <div class="secondary-action">
                                    <?php if (empty($otpSent)): ?>
                                        Enviar código
                                    <?php elseif (isset($otpSent) && !$otpValidated): ?>
                                        Validar código
                                    <?php endif; ?>
                                </div>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- Right Side Image Container -->
    <?php require_once('partials/authPagesRightSide.php'); ?>

    </div>
</body>
</html>

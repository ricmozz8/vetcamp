<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="styles.css">
        <title>VetCamp Application</title>
    </head>

    <body>
        <!-- Main dashboard container -->
        <div class="back-dash">

            <!-- Sidebar navigation -->
            <aside class="sidebar">
                <!-- Logo section -->
                <div class="logo-container">
                    <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
                </div>

                <!-- Main navigation menu -->
                <nav class="nav-links">
                    <a href="/admin" class="nav-item">
                        <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                        <span>Inicio</span>
                    </a>
                    <a href="/admin/requests" class="nav-item">
                        <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                        <span>Solicitudes</span>
                    </a>
                    <a href="/admin/registered" class="nav-item">
                        <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                        <span>Registrados</span>
                    </a>
                    <a href="/admin/settings" class="nav-item">
                        <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                        <span>Ajustes</span>
                    </a>
                </nav>

                <!-- User profile section -->
                <div class="user-profile">
                    <div class="user-avatar" id="userAvatar">U</div>
                    <div class="user-info">
                        <span class="user-email" id="userEmail">usuario@correo.com</span>
                        <a href="#" class="logout">Salir</a>
                    </div>
                </div>
            </aside>


            <!-- Main content area -->
            <div class="main-content">

                <!-- Header with welcome message and action button -->

                <div class="profile-wrapper">
                    <header class="header-logo">
                        <a href="/admin/requests" class=" main-action-bright"><i class="las la-arrow-left"></i></a>
                        <img src="/<?= asset("logo/SVG/vetcamp_full_hoz_b.svg") ?>" alt="Vetcamp Logo" class="h-logo">
                    </header>

                    <section class="applicant-info">
                        <img src="https://placehold.co/1200x1080" alt="Applicant" class="applicant-photo">
                        <div class="applicant-details">
                            <h1>Dulce M. Dorwart Chase</h1>
                            <p>Solicitud hecha: 12 mayo 2024</p>
                            <p>Email: <a class="no-deco-action" href="mailto:ddorwart@icloud.com">ddorwart@icloud.com</a></p>
                            <p>Teléfono: +1 787 555 1234</p>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2>Datos básicos</h2>
                        <div class="data-grid">
                            <div><strong>Dirección Postal</strong>
                                <p>123 Calle falsa, Pueblo de Sésamo, Estados Unidos</p>
                            </div>
                            <div><strong>Dirección Física</strong>
                                <p>124 Calle falsa, Pueblo de Sésamo, Estados Unidos</p>
                            </div>
                            <div><strong>Escuela de procedencia</strong>
                                <p>125 Calle falsa, Plaza Sésamo, Estados Unidos (Privada)</p>
                            </div>
                            <div><strong>Fecha de Nacimiento</strong>
                                <p>15 de mayo de 1987</p>
                            </div>
                            <div><strong>Edad</strong>
                                <p>37</p>
                            </div>
                            <div><strong>Sesión Preferida</strong>
                                <p>3 al 7 de junio de 2025</p>
                            </div>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2>Documentos subidos</h2>
                        <div class="documents-grid">
                            <div><a class="no-deco-action" href="#">Ensayo Escrito</a></div>
                            <div><a class="no-deco-action" href="#">Ensayo en Video</a></div>
                            <div><a class="no-deco-action" href="#">Carta de Autorización</a></div>
                            <div><a class="no-deco-action" href="#">Transcripción de créditos</a></div>
                            <div><a class="no-deco-action" href="#">Solicitud Escrita</a></div>
                            <div><a class="no-deco-action" href="#">Foto 2x2</a></div>
                        </div>
                    </section>

                    <section class="manage-section">
                        <h2>Manejar Solicitud</h2>
                        <div class="status-options">
                            <label class="radio-option"><input type="radio" name="status" checked> Sometida</label>
                            <label class="radio-option"><input type="radio" name="status"> Necesita Cambios</label>
                            <label class="radio-option"><input type="radio" name="status"> Denegada</label>
                            <label class="radio-option"><input type="radio" name="status"> Aprobada</label>
                        </div>
                        <button class="main-action-bright tertiary" onclick="openModal('messageModal')">
                            <i class="las la-envelope"></i>
                            Enviar mensaje</button><br>
<hr><br>
                        <div class="actions">
                            <label>
                                <input type="checkbox"> Notificar al solicitante
                            </label>
                            <button class="secondary main-action-bright">Guardar</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <div id="messageModal" class="modal">
            <div class="modal-content">
                <span class="close-button" onclick="closeModal('messageModal')"><i class="las la-times"></i></span>
                <h2>Enviar mensaje</h2>
                <div class="modal-details">
                    <div>
                        <strong>Enviando a:</strong>
                        <p>Dulce Dorwart</p>
                        <p><a class="no-deco-action" href="mailto:ddorwart@icloud.com">ddorwart@icloud.com</a></p>
                    </div>
                    <div class="status-info">
                        <strong>Estado de la solicitud:</strong>
                        <p><i class="las la-exclamation-triangle"></i>Necesita cambios</p>
                    </div>
                </div>
                <textarea placeholder="Introduce un mensaje aquí..."></textarea>
                <button class="main-action-bright secondary"><i class="las la-paper-plane"></i> Enviar</button>
            </div>
        </div>

        <?= include('partials/footer.php') ?>

    </body>

    </html>

</body>

</html>
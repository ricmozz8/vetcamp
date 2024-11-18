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
                        <img src="<?= $application->url_picture ?>" alt="Applicant" class="applicant-photo">
                        <div class="applicant-details">
                            <h1><?= $user->first_name . " " . $user->last_name ?></h1>
                            <p>Solicitud hecha: <?= ($user->created_at) ?></p>
                            <p>Email: <a class="no-deco-action" href="mailto:<?= $user->email ?>"><?= $user->email ?></a></p>
                            <p>Teléfono: <?= $user->phone_number ?></p>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2>Datos básicos</h2>
                        <div class="data-grid">
                            <div><strong>Dirección Postal</strong>
                                <p>
                                    <?= $postal_address->aline1 . " "
                                        . $postal_address->aline2 . " "
                                        . $postal_address->city . ", "
                                        . $postal_address->zip_code ?>
                                </p>
                            </div>
                            <div><strong>Dirección Física</strong>
                                <p>
                                    <?= $physical_address->aline1 . " "
                                        . $physical_address->aline2 . " "
                                        . $physical_address->city . ", "
                                        . $physical_address->zip_code ?>
                                </p>
                            </div>
                            <div><strong>Escuela de procedencia</strong>
                                <p>
                                    <?= $school_address->street . " "
                                        . $school_address->city . " "
                                        . $school_address->zip_code . " ($school_address->school_type)"
                                    ?>
                                </p>
                            </div>
                            <div><strong>Fecha de Nacimiento</strong>
                                <p><?= $user->birthdate ?></p>
                            </div>
                            <div><strong>Edad</strong>
                                <p><?= $user->get_age() ?></p>
                            </div>
                            <div><strong>Sesión Preferida</strong>
                                <p><?= $preferred_session ?></p>
                            </div>
                        </div>
                    </section>

                    <section class="data-section">
                        <h2>Documentos subidos</h2>
                        <div class="documents-grid">
                            <div><a class="no-deco-action" href="<?= $application->url_written_essay ?>">Ensayo Escrito</a></div>
                            <div><a class="no-deco-action" href="<?= $application->url_video_essay ?>">Ensayo en Video</a></div>
                            <div><a class="no-deco-action" href="<?= $application->url_authorization_letter ?>">Carta de Autorización</a></div>
                            <div><a class="no-deco-action" href="<?= $application->url_transcript ?>">Transcripción de créditos</a></div>
                            <div><a class="no-deco-action" href="<?= $application->url_written_application ?>">Solicitud Escrita</a></div>
                            <div><a class="no-deco-action" href="<?= $application->url_picture ?>">Foto 2x2</a></div>
                        </div>
                    </section>

                    <section class="manage-section">
                        <form action="/admin/requests/update" method="POST">
                            <h2>Manejar Solicitud</h2>
                            <div class="status-options">
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Sometida" <?php echo ($application->status === 'submitted') ? 'checked' : ''; ?>> Sometida
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Necesita Cambios" <?php echo ($application->status === 'need_changes') ? 'checked' : ''; ?>> Necesita Cambios
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Denegada" <?php echo ($application->status === 'denied') ? 'checked' : ''; ?>> Denegada
                                </label>
                                <label class="radio-option">
                                    <input type="radio" name="status" value="Aprobada" <?php echo ($application->status === 'approved') ? 'checked' : ''; ?>> Aprobada
                                </label>
                            </div>
                            <a class="main-action-bright tertiary" onclick="openModal('messageModal')">
                                <i class="las la-envelope"></i>
                                Enviar mensaje</a><br>
                            <hr><br>
                            <div class="actions">
                                <label>
                                    <input name="notify" type="checkbox"> Notificar al solicitante
                                </label>
                                <button class="secondary main-action-bright">Guardar</button>
                            </div>
                    </section>
                    </form>
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
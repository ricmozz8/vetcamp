<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>

<body>
    <!-- Main content area -->
    <div class="back-dash">

        <?php require __DIR__ . '/partials/sidebarAdmin.php'; ?>

        <a onclick="openModal('sidebar')" href="#" class="openSidebar">
            <i class="las la-bars">
            </i>
        </a>

        <!-- Main content area -->
        <main class="main-content">
            <!-- Secondary logo container -->

            <header class="header">
                <h1 class="welcome"> Aceptados </h1>
                <button class="main-action-bright" onclick="openModal('massiveEmailModal')">
                    <i class="las la-envelope"></i>
                    Enviar mensaje
                </button>
            </header>

            <div class="accepted-grouped">
                <div class="accepted-card">
                    <div class="accepted-card-header">
                        <div class="">

                            <h2 class="accepted-card-title">Sección 1 (15 al 20 de julio)</h2>  <!-- Esto se cambia -->
                            <p>
                                <i class="las la-users"></i>
                                1/14 estudiantes  <!-- Esto se cambia -->
                            </p>
                        </div>
                        <button class="main-action-bright">
                            <i class="las la-envelope"></i>
                            Enviar correo  <!-- Esto se cambia -->
                        </button>
                    </div>
                    <div class="accepted-card-list">  <!-- De aqui en adelante, loop por persona en sesión -->
                        <div class="accepted-user-card">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fphotos%2Fimages%2Foriginal%2F002%2F901%2F902%2F95c.png&f=1&nofb=1&ipt=e8f6df058776a57d715f8504ac35876a754aa07ad0211a2b2cc5263753f7929f&ipo=images" alt="userIMG">
                            <h3>Student</h3>
                        </div>
                        
                    </div>
                </div>

                <div class="accepted-card">
                    <div class="accepted-card-header">
                        <div class="">

                            <h2 class="accepted-card-title">Sección 1 (15 al 20 de julio)</h2>  <!-- Esto se cambia -->
                            <p>
                                <i class="las la-users"></i>
                                1/14 estudiantes  <!-- Esto se cambia -->
                            </p>
                        </div>
                        <button class="main-action-bright">
                            <i class="las la-envelope"></i>
                            Enviar correo  <!-- Esto se cambia -->
                        </button>
                    </div>
                    <div class="accepted-card-list">  <!-- De aqui en adelante, loop por persona en sesión -->
                        <div class="accepted-user-card">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fphotos%2Fimages%2Foriginal%2F002%2F901%2F902%2F95c.png&f=1&nofb=1&ipt=e8f6df058776a57d715f8504ac35876a754aa07ad0211a2b2cc5263753f7929f&ipo=images" alt="userIMG">
                            <h3>Student</h3>
                        </div>
                        
                    </div>
                </div>

                <div class="accepted-card">
                    <div class="accepted-card-header">
                        <div class="">

                            <h2 class="accepted-card-title">Sección 1 (15 al 20 de julio)</h2>  <!-- Esto se cambia -->
                            <p>
                                <i class="las la-users"></i>
                                1/14 estudiantes  <!-- Esto se cambia -->
                            </p>
                        </div>
                        <button class="main-action-bright">
                            <i class="las la-envelope"></i>
                            Enviar correo  <!-- Esto se cambia -->
                        </button>
                    </div>
                    <div class="accepted-card-list">  <!-- De aqui en adelante, loop por persona en sesión -->
                        <div class="accepted-user-card">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fphotos%2Fimages%2Foriginal%2F002%2F901%2F902%2F95c.png&f=1&nofb=1&ipt=e8f6df058776a57d715f8504ac35876a754aa07ad0211a2b2cc5263753f7929f&ipo=images" alt="userIMG">
                            <h3>Student</h3>
                        </div>

                    </div>
                </div>

                <div class="accepted-card">
                    <div class="accepted-card-header">
                        <div class="">

                            <h2 class="accepted-card-title">Sección 1 (15 al 20 de julio)</h2>  <!-- Esto se cambia -->
                            <p>
                                <i class="las la-users"></i>
                                1/14 estudiantes  <!-- Esto se cambia -->
                            </p>
                        </div>
                        <button class="main-action-bright">
                            <i class="las la-envelope"></i>
                            Enviar correo  <!-- Esto se cambia -->
                        </button>
                    </div>
                    <div class="accepted-card-list">  <!-- De aqui en adelante, loop por persona en sesión -->
                        <div class="accepted-user-card">
                            <img src="https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Fi.kym-cdn.com%2Fphotos%2Fimages%2Foriginal%2F002%2F901%2F902%2F95c.png&f=1&nofb=1&ipt=e8f6df058776a57d715f8504ac35876a754aa07ad0211a2b2cc5263753f7929f&ipo=images" alt="userIMG">
                            <h3>Student</h3>
                        </div>
                        
                    </div>
                </div>



            <!-- Massive Email Modal -->
            <?php require_once('modals/sendMassiveMailModal.php'); ?>
        </main>
    </div>

    <?php require_once('partials/footer.php'); ?>
</body>

</html>
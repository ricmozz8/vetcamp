<!DOCTYPE html>
<html lang="en">
    <?php
    require_once __DIR__ . '/partials/header.php';
    ?>
    <body>
    <!--- Define your structure here --->
    <div class="back_dash">

      <!-- Left sidebar navigation -->
      <aside class="sidebar">

        <!-- Logo section -->
        <img src="/api/placeholder/144/62" alt="UPR Arecibo" class="logo" />

        <!-- Main navigation menu -->
        <nav class="nav-links">

          <!-- Navigation items with icons -->
          <a href="/" class="nav-item">
            <img src="/api/placeholder/40/40" alt="Home" />Inicio</a>

          <a href="/solicitudes" class="nav-item">
            <img src="/api/placeholder/40/40" alt="Requests" />Solicitudes</a>

          <a href="/registrados" class="nav-item">
            <img src="/api/placeholder/40/40" alt="Users" />Registrados</a>

          <a href="/ajustes" class="nav-item active">
            <img src="/api/placeholder/40/40" alt="Settings" />Ajustes</a>
        </nav>

        <!-- User profile section at bottom of sidebar -->
        <div class="user-profile">
          <div class="user-avatar">U</div>
          <div class="user-info">
            <span class="user-email">usuario@correo.com</span>
            <a href="/logout" class="logout">Salir</a>
          </div>
        </div>
      </aside>

     <!-- Main content area -->
     <main class="main-content">
        <header class="header">
            <h1 class="welcome"> Ajustes </h1>
        </header>

        <!-- Vetcamp dates area -->
        <div>
            <h2 class="stat-title"> Manejar fechas del campamento </h2>
            <br><hr size="4" color=000000><br>
            <div>
                <h3> Manejar sesiones del campamento
                    <button class="edit-button"> Editar </button>
                </h3>
                <br>
                <h3> Manejar fechas limites de registros
                    <button class="edit-button"> Editar </button>
                </h3>
                <br>
            </div>
        </div>

        <!-- Predefined messages area -->
        <div>
            <h2 class="stat-title"> Manejar mensajes predefinidos </h2>
            <br><hr size="4" color=000000><br>
            <div>
                <h3> Editar mensaje para aprobados
                    <button class="edit-button"> Editar </button>
                </h3>
                <br>
                <h3> Editar mensaje para denegados
                    <button class="edit-button"> Editar </button>
                </h3>
                <br>
            </div>
        </div>

        <!-- Request management area -->
        <div>
            <h2 class="stat-title"> Administrar solicitudes </h2>
            <br><hr size="4" color=000000><br>
            <div>
                <h3> Eliminar todas las solicitudes
                    <button class="erase-button"> Borrar </button>
                </h3>
                <br>
                <h3> Eliminar las solicitudes denegadas
                    <button class="erase-button"> Borrar </button>
                </h3>
                <br>
            </div>
        </div>

        <!-- Account management area -->
        <div>
            <h2 class="stat-title"> Administrar cuentas </h2>
            <br><hr size="4" color=000000><br>
            <div>
                <h3> Desactivar cuentas que no solicitaron
                    <button class="erase-button"> Desactivar </button>
                </h3>
                <br>
                <h3> Desactivar todas las cuentas
                    <button class="erase-button"> Desactivar </button>
                </h3>
                <br>
            </div>
        </div>


     </main>
    </div>

    <!-- Footer with copyright information -->
    <footer>
     <p>&copy; <?php echo date('Y'); ?> | Universidad de Puerto Rico Arecibo</p>
     <img class="university-logo" src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra">
    </footer>
    </body>
</html>
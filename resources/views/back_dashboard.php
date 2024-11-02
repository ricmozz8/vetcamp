<!DOCTYPE html>
<html lang="es">
<?php
require __DIR__ . '/partials/header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vetcamp-Login</title>
    
    <!-- External CSS stylesheet for dashboard styling -->
    <link rel="stylesheet" href="css/back_dash_style.css" />
    
    <!-- Google Fonts imports for Schibsted Grotesk and Livvic typography -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Livvic:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,900&family=Schibsted+Grotesk:ital,wght@0,400..900;1,400..900&display=swap" rel="stylesheet">
</head>
<body>
      <!-- Left sidebar navigation -->
      <aside class="sidebar">
        <!-- Logo section -->
        <img src="/api/placeholder/144/62" alt="UPR Arecibo" class="logo" />
        
        <!-- Main navigation menu -->
        <nav class="nav-links">
          <!-- Navigation items with icons -->
          <a href="/inicio" class="nav-item active">
            <img src="/api/placeholder/40/40" alt="Home" />Inicio</a>
            
          <a href="/solicitudes" class="nav-item">
            <img src="/api/placeholder/40/40" alt="Requests" />Solicitudes</a>
            
          <a href="/registrados" class="nav-item">
            <img src="/api/placeholder/40/40" alt="Users" />Registrados</a>
            
          <a href="/ajustes" class="nav-item">
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
        <!-- Header with welcome message and action button -->
        <header class="header">
          <h1 class="welcome">Bienvenido, Usuario</h1>
          <button class="send-message">Enviar mensaje</button>
        </header>

        <!-- Statistics cards grid - First row -->
        <div class="stats-grid">
          <!-- Total applicants card -->
          <div class="stat-card">
            <div class="stat-header">
              <h2 class="stat-title">Solicitantes</h2>
              <a href="/solicitudes" class="view-all">ver todos</a>
            </div>
            <div class="stat-number">75</div>
          </div>
          <!-- Total registered users card -->
          <div class="stat-card">
            <div class="stat-header">
              <h2 class="stat-title">Registrados</h2>
              <a href="/registrados" class="view-all">ver todos</a>
            </div>
            <div class="stat-number">129</div>
          </div>
        </div>

        <!-- Statistics cards grid - Second row -->
        <div class="stats-grid">
          <!-- Recent applications list card -->
          <div class="stat-card">
            <h2 class="stat-title">Solicitudes más recientes</h2>
            <div class="recent-list">
              <!-- Recent application items with avatar and user info -->
              <div class="recent-item">
                <img src="/api/placeholder/48/48" alt="" class="avatar" />
                <div class="recent-info">
                  <span class="recent-name">Talan Rhiel Madsen</span>
                  <span class="recent-email">nombre@correo.com</span>
                </div>
              </div>
              <!-- Additional recent application items... -->
            </div>
            <button class="view-all-button">Ver todos</button>
          </div>

          <!-- Recent registrations list card -->
          <div class="stat-card">
            <h2 class="stat-title">Registros Recientes</h2>
            <div class="recent-list registros-list">
              <!-- Recent registration items with timestamp -->
              <div class="recent-item">
                <span class="recent-email">smitchell@icloud.com</span>
                <span class="time-stamp">hoy a las 9:57pm</span>
              </div>
              <!-- Additional recent registration items... -->
            </div>
            <button class="view-all-button">Ver todos</button>
          </div>
        </div>
      </main>

      <!-- Footer with copyright information -->
      <footer class="footer">
        Copyright 2024 | Universidad de Puerto Rico Arecibo
      </footer>
</body>
</html>
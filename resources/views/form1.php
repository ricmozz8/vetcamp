<!DOCTYPE html>
<html lang="en">
<?php

// Incluir la clase Auth
require_once 'kernel/auth.php';
require __DIR__ . '/partials/header.php';

/*
// Verificar si el usuario está logueado
if (!Auth::check()) {
    // Si no está logueado, redirigir a la página de login
    header("Location: /login");
    exit();
}
*/
?>

<body>
    <!--- Define your structure here --->
    <h1>Mis Solicitudes</h1>
    <h3>Vetcamp Verano 2025</h3>
    <p>Campamento de verano para estudiante de la escuela superior interesado en la tecnología veterinaria. Se llevará a cabo 4 sesiones.</p>
    <p>Estado: sin llenar</p>
    <a href="/login/auth/form2">Llenar solicitud</a>

</body>

</html>
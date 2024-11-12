<!DOCTYPE html>
<html lang="en">
<?php

// Incluir la clase Auth
require_once 'kernel/auth.php';
require __DIR__ . '/partials/header.php';

// Verificar si el usuario está logueado
/*
if (!Auth::check()) {
    // Si no está logueado, redirigir a la página de login
    header("Location: /login");
    exit();
}*/
echo "Hola Mundo";
?>

<body>
    <!--- Define your structure here --->

</body>

</html>
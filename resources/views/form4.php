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
}
    */
if ($_SERVER["REQUEST_METHOD"] == "POST"){
    // Dirección Física
    $lineaDeCalle1FIS = $_POST['lineaDeCalle1FIS'] ?? null;
    $lineaDeCalle2FIS = $_POST['lineaDeCalle2FIS'] ?? null;
    $cuidadFIS = $_POST['cuidadFIS'] ?? null;
    $codigoPostalFIS = $_POST['codigoPostalFIS'] ?? null;

    $sonIguales = isset($_POST['sonIguales']) ? true : false; 

    if($sonIguales){
        $lineaDeCalle1POS = $lineaDeCalle1FIS;
        $lineaDeCalle2POS = $lineaDeCalle2FIS;
        $cuidadPOS = $cuidadFIS;
        $codigoPostalPOS = $codigoPostalFIS;
    }
    else {
        // Dirección Postal
        $lineaDeCalle1POS = $_POST['lineaDeCalle1POS'] ?? null;
        $lineaDeCalle2POS = $_POST['lineaDeCalle2POS'] ?? null;
        $cuidadPOS = $_POST['cuidadPOS'] ?? null;
        $codigoPostalPOS = $_POST['codigoPostalPOS'] ?? null;
    }
    // guardar valores en la sesion
    $_SESSION['lineaDeCalle1FIS'] = $lineaDeCalle1FIS;
    $_SESSION['lineaDeCalle2FIS'] = $lineaDeCalle2FIS;
    $_SESSION['cuidadFIS'] = $cuidadFIS; 
    $_SESSION['codigoPostalFIS'] = $codigoPostalFIS;

    $_SESSION['lineaDeCalle1POS'] = $lineaDeCalle1POS;
    $_SESSION['lineaDeCalle2POS'] = $lineaDeCalle2POS;
    $_SESSION['cuidadPOS'] = $cuidadPOS;
    $_SESSION['codigoPostalPOS'] = $codigoPostalPOS;
}
?>

<body>
    <!--- Define your structure here --->
    <h1>Vetcamp Verano 2025</h1>
    <h3>Documentos</h3>
    <form  action="/login/auth/form5" method="post" enctype="multipart/form-data">
        <label for="solicitudEscrita">Solicitud Escrita:</label><br>
        <input type="file" id="solicitudEscrita" name="solicitudEscrita"><br>

        <label for="ensayoEscrito">Ensayo Escrito:</label><br>
        <input type="file" id="ensayoEscrito" name="ensayoEscrito"><br>

        <label for="ensayoVideo">Ensayo De Video:</label><br>
        <input type="file" id="ensayoVideo" name="ensayoVideo"><br>

        <label for="cartaDeAutorizacion">Carta De Autorizacion:</label><br>
        <input type="file" id="cartaDeAutorizacion" name="cartaDeAutorizacion"><br>

        <label for="transcripcionDeCredito">Transcripcion De Credito:</label><br>
        <input type="file" id="transcripcionDeCredito" name="transcripcionDeCredito"><br>

        <label for="foto">Foto 2x2:</label><br>
        <input type="file" id="foto" name="foto"><br>

        <input type="button" value="Guardar">
        <input type="submit" value="Siguiente">
    </form>

</body>

</html>
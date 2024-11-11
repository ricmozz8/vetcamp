<!DOCTYPE html>
<html lang="en">
<?php
require_once 'kernel/auth.php';
require __DIR__ . '/partials/header.php';

// Verificar si el usuario está logueado
/*
if (!Auth::check()) {
    header("Location: /login");
    exit();
}
    */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fecha_de_nacimiento = $_POST['fecha_de_nacimiento'] ?? null;
    $sesion = $_POST['sesion'] ?? null;
    $calle = $_POST['calle'] ?? null;
    $ciudad = $_POST['cuidad'] ?? null;
    $codigoPostal = $_POST['codigoPostal'] ?? null;
    $tipoDeEscuela = $_POST['tipoDeEscuela'] ?? null;

    // Verificar si se han recibido los valores
    if ($fecha_de_nacimiento && $sesion && $calle && $ciudad && $codigoPostal && $tipoDeEscuela) {
        $_SESSION['fecha_de_nacimiento'] = $fecha_de_nacimiento;
        $_SESSION['sesion'] = $sesion;
        $_SESSION['calle'] = $calle;
        $_SESSION['cuidad'] = $ciudad;
        $_SESSION['codigoPostal'] = $codigoPostal;
        $_SESSION['tipoDeEscuela'] = $tipoDeEscuela;
    } else {
        echo "Faltan campos por llenar.";
    }
}

?>

<body>
    <!--- Define your structure here --->
    <h1>Vetcamp Verano 2025</h1>
    <h3>Dirección física</h3>
    <form action="/login/auth/form4" method="post">
        <label for="lineaDeCalle1FIS">Linea De Calle 1:</label><br>
        <input type="text" id="lineaDeCalle1FIS" name="lineaDeCalle1FIS"><br>

        <label for="lineaDeCalle2FIS">Linea De Calle 2:</label><br>
        <input type="text" id="lineaDeCalle2FIS" name="lineaDeCalle2FIS"><br>

        <label for="cuidadFIS">Cuidad:</label><br>
        <input type="text" id="cuidadFIS" name="cuidadFIS"><br>

        <label for="codigoPostalFIS">Código Postal::</label><br>
        <input type="text" id="codigoPostalFIS" name="codigoPostalFIS"><br>

        <br>

        <h3>Dirección Postal</h3>
        <input type="checkbox" id="sonIguales" name="sonIguales"/>
        <label for="sonIguales">Misma que la física</label>

        <br>

        <label for="lineaDeCalle1POS">Linea De Calle 1:</label><br>
        <input type="text" id="lineaDeCalle1POS" name="lineaDeCalle1POS"><br>

        <label for="lineaDeCalle2POS">Linea De Calle 2:</label><br>
        <input type="text" id="lineaDeCalle2POS" name="lineaDeCalle2POS"><br>

        <label for="cuidadPOS">Cuidad:</label><br>
        <input type="text" id="cuidadPOS" name="cuidadPOS"><br>

        <label for="codigoPostalPOS">Código Postal::</label><br>
        <input type="text" id="codigoPostalPOS" name="codigoPostalPOS"><br>

        <input type="button" value="Guardar">
        <input type="submit" value="Siguiente">
    </form>
    <br>
    <br>

</body>

</html>
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
?>

<body>
    <!--- Define your structure here --->
    <h1>Vetcamp Verano 2025</h1>
    <form action="/login/auth/form3" method="post">
        <label for="fecha_de_nacimiento">Fecha de nacimiento:</label><br>
        <input type="date" id="fecha_de_nacimiento" name="fecha_de_nacimiento"><br>
        <fieldset>
            <legend>Sesiones disponibles:</legend>

            <div>
                <input type="radio" name="sesion" value="sesion1"/>
                <label for="sesion1">Sesión 1</label>
            </div>

            <div>
                <input type="radio" name="sesion" value="sesion2"/>
                <label for="sesion2">Sesión 2</label>
            </div>

            <div>
                <input type="radio" name="sesion" value="sesion3"/>
                <label for="sesion3">Sesión 3</label>
            </div>

            <div>
                <input type="radio" name="sesion" value="sesion4"/>
                <label for="sesion4">Sesión 4</label>
            </div>
        </fieldset>
        <label for="calle">Calle:</label><br>
        <input type="text" id="calle" name="calle"><br>

        <label for="cuidad">Cuidad:</label><br>
        <input type="text" id="cuidad" name="cuidad"><br>

        <label for="codigoPostal">Código Postal:</label><br>
        <input type="text" id="codigoPostal" name="codigoPostal"><br>
        <fieldset>
            <legend>Tipo de escuela:</legend>

            <div>
                <input type="radio" id="tipoDeEscuela1" name="tipoDeEscuela" value="publica"/>
                <label for="tipoDeEscuela1">Publica</label>
            </div>

            <div>
                <input type="radio" id="tipoDeEscuela2" name="tipoDeEscuela" value="privada"/>
                <label for="tipoDeEscuela2">Privada</label>
            </div>
        </fieldset>
        <input type="button" value="Guardar">
        <input type="submit" value="Siguiente">
    </form> 
    <br>
    <br>

</body>

</html>
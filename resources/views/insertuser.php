<!DOCTYPE html>
<html lang="en">
<?php

// Incluir la clase Auth
require_once 'kernel/auth.php';
require __DIR__ . '/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if($password != $confirmPassword)
    {
        echo "La contra esta mala";
        exit();
    }

    // Validación básica (puedes agregar más validaciones según necesites)
    if (empty($nombre) || empty($telefono) || empty($correo) || empty($password) || empty($confirmPassword) ){
        echo "Todos los campos son obligatorios.";
        exit;
    }
}
    // Encriptar la contraseña
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    //colocar el nombre y el apellido
    $partesNombre = explode(" ", $nombre);
    $primerNombre = $partesNombre[0];
    $apellido = isset($partesNombre[1]) ? $partesNombre[1] : '';

    $data = [
        'email' => $correo,
        'password' => $passwordHash,
        'first_name' => $primerNombre,
        'last_name' => $apellido,
        'phone_number' => $telefono,
        'status' => "active",
        'type' => "user",
        'created_at'=> date('Y-m-d H:i:s'),

    ];
    try {
        $table = 'users'; 
        $insertResult = DB::insert($table, $data);

        if ($insertResult) {
            echo "¡Usuario registrado con éxito!";
            // Redirigir al usuario a la página de inicio de sesión, por ejemplo
            header("Location: /");
            exit;
        } else {
            echo "Hubo un problema al registrar el usuario. Por favor, intenta de nuevo.";
        }
    } catch (Exception $e) {
        echo "Error al registrar el usuario: " . $e->getMessage();
    }
?>
<!DOCTYPE html>
<html lang="en">
<?php

// Incluir la clase Auth
require_once 'kernel/auth.php';
require_once 'app/models/User.php';
require __DIR__ . '/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') 
{
    // Obtener los datos del formulario
    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if($password != $confirmPassword)
    {
        echo "Los password no son iguales <br>";
        exit();
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
    ob_clean();
    header('Location: /login');
    $userCreated = User::register($data);
    
}
?>
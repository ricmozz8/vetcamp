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

    $dataFormulario = [
        'nombre' => $nombre,
        'telefono' => $telefono,
        'correo' => $correo,
        'password' => $password,
        'confirm_password' => $confirmPassword,
    ];
    ob_clean();
    header('Location: /login');
    $userCreated = User::register($dataFormulario);
    
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/partials/header.php';
?>

<body style="background-color: white; color:black;">
    <!--- Define your structure here --->
    <h1 style="font-size: 6em;">Users</h1>
    <?php
   
    // echo "<ul>";
    // echo "User name: " . $user['primer_nombre']  . " " . $user['apellidos'] . "<br>";
    // echo "User email: " . $user['correo'] . "<br>";
    // echo "User phone: " . format_phone($user['telefono']) . "<br>";
    // echo "Registered on: " . $user['fecha_registro'] . "<br>";

    if($user)
    {
        $application = $user->application();
    } else {
        $application = null;
    }

    dd($application);
    echo "</ul>";
    
    ?>
</body>

</html>
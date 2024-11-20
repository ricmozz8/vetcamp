<!DOCTYPE html>
<html lang="es">
<?php
require_once __DIR__ . '/partials/header.php';
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        .profile-col {
            width: 10%;
        }
        .name-col {
            width: 20%;
        }
        .email-col {
            width: 20%;
        }
        .documents-col {
            width: 10%;
        }
        .status-col {
            width: 15%;
        }
        .date-col {
            width: 15%;
        }
        img.profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
        .review-link {
            color: blue;
            text-decoration: underline;
            cursor: pointer;
        }
    </style>
    <title>Solicitants List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="profile-col">Perfil</th>
                <th class="name-col">Nombre</th>
                <th class="email-col">Correo</th>
                <th class="documents-col">Documentos</th>
                <th class="status-col">Estado</th>
                <th class="date-col">Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php

            // Set locale to Spanish
            setlocale(LC_TIME, 'es_ES.UTF-8');

            // Loop through the solicitants returned by the User::allRegistered() method
            foreach ($solicitants as $user) {
                // Get the full name and formatted date
                $profile_pic = $user->application->profile_pic ?? 'https://upload.wikimedia.org/wikipedia/commons/9/9a/Sagrado_Cora%C3%A7%C3%A3o_de_Jesus_-_escola_portuguesa%2C_s%C3%A9culo_XIX.png';  // Default image path
                $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                $date = new DateTime($user->created_at);
                $formatted_date = strftime('%e %B %Y', $date->getTimestamp());

                echo "<tr>";
                echo "<td><img src='$profile_pic' alt='Profile Picture' style='width: 100px; height: 100px; border-radius: 50%; object-fit: cover;'></td>";
                echo "<td>" . $full_name . "</td>";
                echo "<td>" . htmlspecialchars($user->email) . "</td>";
                echo "<td>" . htmlspecialchars($user->application()->documentCount()) . "/6</td>";                
                echo "<td>" . htmlspecialchars($user->status) . "</td>";
                echo "<td>" . ucfirst($formatted_date) . "</td>"; // Capitalize the first letter of the month
                echo "<td><a href='#' class='review-link'>revisar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

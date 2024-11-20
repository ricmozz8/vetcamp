<!DOCTYPE html>
<html lang="en">
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
            font-family: Arial, sans-serif;
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
        .email-col {
            width: 20%;
        }
        .status-col {
            width: 10%;
        }
        .date-col {
            width: 15%;
        }
        img.profile-pic {
            width: 40px;
            height: 40px;
            border-radius: 50%;
        }
    </style>
    <title>User List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="email-col">Correo</th>
                <th class="status-col">¿Ha solicitado?</th>
                <th class="date-col">Fecha de registro</th>
            </tr>
        </thead>
        <tbody>
        <?php
            // Set locale to Spanish
                setlocale(LC_TIME, 'es_ES.UTF-8'); 

            foreach ($users as $user) {
                $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
    
            // Convert the created_at date to "day month year" format in Spanish (e.g., "10 de Julio 2025")
            $date = new DateTime($user->created_at);
            $formatted_date = strftime('%e %B %Y', $date->getTimestamp()); 

            $has_application = $user->application() ? 'Sí' : 'No';

            echo "<tr>";
            echo "<td>" . htmlspecialchars($user->email) . "</td>";
            echo "<td>" . ($has_application) . "</td>";
            echo "<td>" . htmlspecialchars(ucfirst($formatted_date)) . "</td>"; // Capitalize the first letter of the month
            echo "</tr>";       
            }
        ?>
        </tbody>
    </table>
</body>
</html>
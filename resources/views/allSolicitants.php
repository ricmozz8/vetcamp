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
        .email-col {
            width: 20%;
        }
        .status-col {
            width: 10%;
        }
        .date-col {
            width: 15%;
        }
    </style>
    <title>Solicitants List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th class="email-col">Email</th>
                <th>Status</th>
                <th class="date-col">Created At</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop throught the solicitants returned by the User::allRegistered() method
            foreach ($solicitants as $user) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($user->email) . "</td>";
                echo "<td>" . htmlspecialchars($user->status) . "</td>";
                echo "<td>" . htmlspecialchars($user->created_at) . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<?php
require_once __DIR__ . '/partials/header.php';
?>
<head>
    <style>
        /*******************************
         * Requests Table
         * Primary structural elements that define the requests/registered tables
         * NOTE: Styles won't load if moved outside the view as of right now, will update soon
         *******************************/
        .requests {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .requests .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .requests h1 {
            font-size: 24px;
            margin: 0;
        }
        .requests .search-container {
            position: relative;
        }
        .requests .search-input {
            padding: 8px 8px 8px 40px;
            border: 1px solid #e0e0e0;
            border-radius: 20px;
            font-size: 14px;
            width: 300px;
        }
        .requests .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #888;
        }
        .requests table {
            width: 100%;
            border-collapse: collapse;
        }
        .requests th, .requests td {
            text-align: left;
            padding: 12px 20px;
            border-bottom: 1px solid #e0e0e0;
        }
        .requests th {
            background-color: #f9f9f9;
            font-weight: bold;
            color: #333;
        }
        .requests .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            object-fit: cover;
        }
        .requests .status {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: bold;
        }
        .requests .action:hover {
            text-decoration: underline;
        }
        .requests .pagination {
            display: flex;
            justify-content: center;
            padding: 20px;
            border-top: 1px solid #e0e0e0;
        }
        .requests .page-number {
            margin: 0 4px;
            padding: 8px 12px;
            border: 1px solid #e0e0e0;
            border-radius: 4px;
            text-decoration: none;
            color: #333;
        }
        .requests .page-number:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>
<body>
<!--- Define your structure here --->
<div class="back-dash">

    <!-- Sidebar navigation -->
    <aside class="sidebar">
        <!-- Logo section -->
        <div class="logo-container">
            <img src="https://upra.edu/wp-content/uploads/2015/08/arecibo.png" alt="logo upra" class="logo-upr">
        </div>

        <!-- Main navigation menu -->
        <nav class="nav-links">
            <a href="/admin" class="nav-item">
                <img src="https://img.icons8.com/?size=100&id=kzcQaYg7aTjb&format=png&color=1A1A1A" alter="Home Icon" class="nav-icon">
                <span>Inicio</span>
            </a>
            <a href="requests" class="nav-item">
                <img src="https://img.icons8.com/?size=100&id=tfnuCxzS4iEn&format=png&color=1A1A1A" alter="Applicants Icon" class="nav-icon">
                <span>Solicitudes</span>
            </a>
            <a href="registered" class="nav-item active">
                <img src="https://img.icons8.com/?size=100&id=aPUUXqLMszEs&format=png&color=1A1A1A" alter="Registered Icon" class="nav-icon">
                <span>Registrados</span>
            </a>
            <a href="settings" class="nav-item">
                <img src="https://img.icons8.com/?size=100&id=4511GGVppfIx&format=png&color=1A1A1A" alter="Settings Icon" class="nav-icon">
                <span>Ajustes</span>
            </a>
        </nav>

        <!-- User profile section -->
        <div class="user-profile">
            <div class="user-info">
                <span class="user-email" id="userEmail"><?php echo Auth::user()->email; ?></span>
                <a href="/logout" class="logout">Salir</a>
            </div>
        </div>
    </aside>

    <!-- Main content area -->
    <main class="main-content">
    <!-- Secondary logo container -->
        <div class="logo-container">
        <img src="/resources/assets/logo/SVG/vetcamp_full_hoz_b.svg" alt="Vetcamp" class="logo logo-right">
        </div>

        <div class="requests">
            <div class="header">
                <div class="welcome">Registrados</div>
                <div class="search-container">
                    <input type="text" class="search-input" placeholder="Busca correos, nombres, fechas">
                    <span class="search-icon"><img src="https://img.icons8.com/?size=100&id=84039&format=png&color=000000" class="main-icons"></span>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        
                        <th>Nombre</th>
                        <th>Correo</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Loop through the users returned by the User::all() method
                        foreach ($users as $user) {
                            // Get the full name
                            $full_name = htmlspecialchars($user->first_name . ' ' . $user->last_name);
                            $date = new DateTime($user->created_at);
                            echo "<tr>";
                            echo "<td>" . $full_name . "</td>";
                            echo "<td>" . htmlspecialchars($user->email) . "</td>";
                            echo "<td>" . htmlspecialchars($user->status) . "</td>";
                            echo "<td>" . htmlspecialchars($date->format('d-m-Y')) . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
            </table>
            <div class="pagination">
                <a href="#" class="page-number">1</a>
                <a href="#" class="page-number">2</a>
                <a href="#" class="page-number">3</a>
                <a href="#" class="page-number">4</a>
            </div>
        </div>

    </main>
    </div>

    <!-- Footer with copyright information -->
    <?php require_once('partials/footer.php'); ?>

</body>
</html>
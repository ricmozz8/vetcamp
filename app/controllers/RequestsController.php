<?php
require_once 'Controller.php';

class RequestsController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type !== 'admin') {
            redirect('/login');
        }
        $estado = isset($_GET['estado']) && $_GET['estado'] !== '-1' ? (int)$_GET['estado'] : 0;
        // storing users
        // $users = User::allApplicants();

        // dd(User::findLike(['first_name' => '%est%']));

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 6; // Set the number of users per page
        
        // Get all applicants
        $allApplicants = User::allApplicants();

        // Calculate total pages
        $totalUsers = count($allApplicants);
        $totalPages = ceil($totalUsers / $perPage);

        // Ensure the current page is within bounds
        $page = max(1, min($page, $totalPages));

        // Get the slice of users for the current page
        $offset = ($page - 1) * $perPage;

        $arrayUsers = [];
        
        // filtrar las solicitudes
        foreach ($allApplicants as $user) {
            $application = $user->application();
            switch ($estado) { 
                case 0:
                    $arrayUsers = User::allApplicants();
                    break;
                case 1:
                    if($application->status == "Sometida") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 2:
                    if($application->status == "Necesita Cambios") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 3:
                    if($application->status == "Aceptado") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 4:
                    if($application->status == "Rechazado") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 5:
                    if($application->status == "Incompleta") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 6:
                    if($application->status == "En lista de espera") {
                        $arrayUsers[] = $user;
                    }
                    break;
            }
        }
        $users = array_slice($arrayUsers, $offset, $perPage);

        render_view('requests', [
            "users" => $users,
            'selected' => 'requests',
            'currentPage' => $page,
            'totalPages' => $totalPages,
        ], 'Solicitudes');
    }
    // define your other methods here
}

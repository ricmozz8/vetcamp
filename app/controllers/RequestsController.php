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

        $order = isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc']) ? $_GET['order'] : 'desc';
        $doc_order = isset($_GET['doc']) && in_array($_GET['doc'], ['asc', 'desc']) ? $_GET['doc'] : null;
        $s = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);


        $application_status = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT) ?: 0;
        

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
            switch ($application_status) {
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
                default:
                    $arrayUsers = User::allApplicants();
                    break;
            }
        }

        usort($arrayUsers, function ($a, $b) use ($order, $doc_order) {
            $dateA = strtotime($a->application()->date_created);
            $dateB = strtotime($b->application()->date_created);
        
            // Ordenar primero por fecha
            $dateComparison = $order === 'asc' ? $dateA - $dateB : $dateB - $dateA;
        
            if ($doc_order) {
                $docA = $a->application()->documentCount();
                $docB = $b->application()->documentCount();
                $docComparison = $doc_order === 'asc' ? $docA - $docB : $docB - $docA;
                return $docComparison !== 0 ? $docComparison : $dateComparison;
            }
        
            return $dateComparison;
        });
        


        $users = array_slice($arrayUsers, $offset, $perPage);


        if (!empty($s)) {
            $searchTerm = $s . "%";

            try {
                $users = User::findLike([
                    'first_name' => $searchTerm,
                    'last_name' => $searchTerm,
                    'email' => $searchTerm
                ]);
            } catch (ModelNotFoundException $notFound) {
                $users = [];
            }
        }

        render_view('requests', [
            "users" => $users,
            'selected' => 'requests',
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'order' => $order,
        ], 'Solicitudes');
    }
    // define your other methods here
}

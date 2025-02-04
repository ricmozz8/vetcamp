<?php
require_once 'Controller.php';

class RegisteredController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 7; // Set the number of users per page

        // Get all users
        $allUsers = User::allof('user');

        // Calculate total pages
        $totalUsers = count($allUsers);
        $totalPages = ceil($totalUsers / $perPage);

        // Ensure the current page is within bounds
        $page = max(1, min($page, $totalPages));

        // Get the slice of users for the current page
        $offset = ($page - 1) * $perPage;
        $users = array_slice($allUsers, $offset, $perPage);

        // Filtering users
        // storing users
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $palabra = $_POST['search'];
                if (!empty($palabra)) {
                    $searchTerm = $palabra . "%";
                    // Realizar la búsqueda en las columnas relevantes
                    $users = User::findLike([
                        'first_name' => $searchTerm,
                        'last_name' => $searchTerm,
                        'email' => $searchTerm
                    ]);
                } else {
                    $users = User::allof('user');
                }
            } else {
                $users = User::allof('user');
            }
        } catch (ModelNotFoundException $e) {
            $users = [];
        }
        // end filtro

        // your index view here
        render_view('registered', [
            "users" => $users,
            'selected' => 'registered',
            'currentPage' => $page,
            'totalPages' => $totalPages
        ], 'Registered');
        
     
        
    }

    // define your other methods here
}

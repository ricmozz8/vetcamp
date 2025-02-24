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
        $users = User::allof('user');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $s = filter_input(INPUT_POST, 'search', FILTER_DEFAULT);
            if (!empty($s)) {
                $searchTerm = $s . "%";

                try {
                    $users = User::findLike([
                        'first_name' => $searchTerm,
                        'last_name' => $searchTerm,
                        'email' => $searchTerm
                    ]);
                } catch (ModelNotFoundException $notFound) {

                    $_SESSION['error'] = 'No se encontraron resultados';
                    redirect('/admin/registered');
                }
            }
        }


        // your index view here
        render_view('registered', [
            "users" => $users,
            'selected' => 'registered',
            'currentPage' => $page,
            'totalPages' => $totalPages
        ], 'Usuarios');
    }

    public static function changeStatus($request_method) {
        if ($request_method === "POST") {
            $id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
            $action = isset($_POST['action']) ? $_POST['action'] : null;
        }
        if($id){
            $user = User::find($id);
            //evitar un query sin sentido
            if ($action === $user->status) {
                $_SESSION['error'] = "Ya el usuario tiene ese estado.";
                redirect('/admin/registered');
            }
        } 
        else {
            RegisteredController::index();
        }
        
        User::updateStatus('users', ['status' => $action], 'user_id', $id);
        RegisteredController::index();
    }
    // define your other methods here
}

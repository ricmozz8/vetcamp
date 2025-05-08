<?php
require_once 'Controller.php';
require_once __DIR__ . '/../models/Activation.php';

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

        $users_status = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT) ?: 0;



        // Filtering users
        // storing users
        $users = User::allof('user');

        $s = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);

        $order = isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc']) ? $_GET['order'] : 'desc';

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 7; // Set the number of users per page

        // Calculate total pages
        $totalUsers = count($users);
        $totalPages = ceil($totalUsers / $perPage);

        // Ensure the current page is within bounds
        $page = max(1, min($page, $totalPages));

        // Get the slice of users for the current page
        $offset = ($page - 1) * $perPage;
        $arrayUsers = [];

        foreach ($users as $user) {
            switch ($users_status) {
                case 1:
                    if($user->status == "active") {
                        $arrayUsers[] = $user;
                    }
                    break;
                case 2:
                    if($user->status == "disabled") { 
                        $arrayUsers[] = $user;
                    }
                    break;    
                default:
                    $arrayUsers = $users;
                    break;
            }
        }

        // Ordenar por fecha
        usort($arrayUsers, function ($a, $b) use ($order) {
            $dateA = strtotime($a->created_at);
            $dateB = strtotime($b->created_at);
            return $order === 'asc' ? $dateA - $dateB : $dateB - $dateA;
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

        // your index view here
        render_view('registered', [
            "users" => $users,
            'selected' => 'registered',
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'order' => $order
        ], 'Usuarios');
    }

    public static function changeStatus($request_method) {
        if ($request_method === "POST") {
            $id = isset($_POST['user_id']) ? $_POST['user_id'] : null;
            $action = isset($_POST['action']) ? $_POST['action'] : null;
        } else {
            $id = null;
        }
    
        if ($id) {
            $user = User::find($id);
            // Evitar un cambio innecesario
            if ($action === $user->status) {
                $_SESSION['error'] = "Ya el usuario tiene ese estado.";
                redirect('/admin/registered');
            } else if ($action === 'disabled') { 
                // Enviar email si el usuario es deshabilitado
                User::sendEmailForReactivate($user);
            }
    
            User::updateStatus('users', ['status' => $action], 'user_id', $id);
        } else {
            RegisteredController::index();
        }
        redirect('/admin/registered');
    }
    
   
    /**
     * Descarga un archivo CSV con los datos de los usuarios.
     *
     * @return void
     */
    public static function downloadCsvUsers() 
    
{

        $users = User::all();
    
        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="usuariosRegistrados.csv"');
          
        $fp = __DIR__."/../../storage/private/usuariosRegistrados.csv";

       $columns = ['Nombre','Email', 'Estado', 'Fecha'];

       file_put_contents($fp, implode(',', $columns) . "\n", FILE_APPEND);

        $statusParsing = [
            'active' => 'Activo',
            'disabled' => 'Desactivado'
        ];

        foreach ($users as $user) 
        {
            $row = [
                $user->first_name.' '.$user->last_name,
                $user->email,
                $statusParsing[$user->status]??$user->status,
                get_date_spanish($user->created_at)
            ];
            file_put_contents($fp, implode(',', $row) . "\n", FILE_APPEND);
        }
        readfile($fp);
        unlink($fp);
        exit;
}

}

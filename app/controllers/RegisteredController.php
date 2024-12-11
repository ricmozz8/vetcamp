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
        
        // storing users
        // $users = User::allof('user');

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 9; // Set the number of users per page

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

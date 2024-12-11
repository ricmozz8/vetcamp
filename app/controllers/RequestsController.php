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
    public static function index()
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }
        // storing users
        // $users = User::allApplicants();

        // dd(User::findLike(['first_name' => '%est%']));

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 7; // Set the number of users per page

        // Get all applicants
        $allApplicants = User::allApplicants();

        // Calculate total pages
        $totalUsers = count($allApplicants);
        $totalPages = ceil($totalUsers / $perPage);

        // Ensure the current page is within bounds
        $page = max(1, min($page, $totalPages));

        // Get the slice of users for the current page
        $offset = ($page - 1) * $perPage;
        $users = array_slice($allApplicants, $offset, $perPage);

        render_view('requests', [
            "users" => $users,
            'selected' => 'requests',
            'currentPage' => $page,
            'totalPages' => $totalPages
        ], 'Requests');
    }

    // define your other methods here
}

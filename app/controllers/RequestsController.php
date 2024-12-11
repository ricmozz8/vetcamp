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
        $users = User::allApplicants();

        // dd(User::findLike(['first_name' => '%est%']));

                // storing users
                // if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //     $palabra = $_POST['search'];
                
                //     if (!empty($palabra)) {
                //         $searchTerm = $palabra . "%";
                
                //         // Realizar la búsqueda en las columnas relevantes
                //         $users = User::findLike([
                //             'first_name' => $searchTerm,
                //             'last_name' => $searchTerm,
                //             'email' => $searchTerm
                //         ]);
                //     } else {
                //         $users = User::allApplicants();
                //     }
                // } else {
                //     $users = User::allApplicants();
                //     render_view('requests', ["users" => $users, 'selected' => 'requests'], 'Requests');
                // }
                render_view('requests', ["users" => $users, 'selected' => 'requests'], 'Requests');

        // your index view here
    }

    // define your other methods here
}

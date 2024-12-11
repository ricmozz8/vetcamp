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
        render_view('registered', ["users" => $users, 'selected' => 'registered'], 'Registered');
    }

    // define your other methods here
}

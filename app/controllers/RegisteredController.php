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
        if (!Auth::check() or Auth::user()->type != 'admin') {
            redirect('/login');
        }
        
        // storing users
        $users = User::allof('user');

        // your index view here
        render_view('registered', ["users" => $users,'selected' => 'registered'], 'Registered');
    }

    // define your other methods here
}

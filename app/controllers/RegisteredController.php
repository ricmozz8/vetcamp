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
        // storing users
        $users = User::all();

        // your index view here
        render_view('registered', ["users" => $users], 'Registered');
    }

    // define your other methods here
}

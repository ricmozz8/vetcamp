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
        // storing users
        $users = User::all();

        // your index view here
        render_view('requests', ["users" => $users], 'Requests');
    }

    // define your other methods here
}

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
        if (!Auth::check() and !Auth::user()->type == 'admin') {
            redirect('/login');
        }
        
        // storing users
        $users = User::allApplicants();   

        // your index view here
        render_view('requests', ["users" => $users], 'Requests');
    }

    // define your other methods here
}

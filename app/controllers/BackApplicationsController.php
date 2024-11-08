<?php
require_once 'Controller.php';

class BackApplicationsController extends Controller
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
        render_view('backApplications', ["users" => $users], 'backapplications');
    }

    // define your other methods here
}

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
        // your index view here
        render_view('backApplications', [], 'BackApplications');
    }

    // define your other methods here
}

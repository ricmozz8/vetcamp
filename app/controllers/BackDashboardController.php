<?php
require_once 'Controller.php';

class BackDashboardController extends Controller
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
        render_view('backdashboard', [], 'BackDashboard');
    }

    // define your other methods here
}

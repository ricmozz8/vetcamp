<?php
require_once 'Controller.php';

class BackRequestsController extends Controller
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
        render_view('backRequests', [], 'BackRequests');
    }

    // define your other methods here
}

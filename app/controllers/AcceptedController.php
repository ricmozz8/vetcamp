<?php
require_once 'Controller.php';

class AcceptedController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        render_view('accepted', ['selected' => 'accepted'], 'Accepted');
    }

    // define your other methods here
}

<?php
require_once 'Controller.php';

class PassResetController extends Controller
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
        render_view('passreset', [], 'PassReset');
    }

    // define your other methods here
}

<?php
require_once 'Controller.php';

class LoginController extends Controller
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
        render_view('login', [], 'Login');
    }

    // define your other methods here
}

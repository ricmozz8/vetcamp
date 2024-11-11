<?php
require_once 'Controller.php';

class RegisterController extends Controller
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
        render_view('register', [], 'Register');
    }

    public static function insertuser()
    {
        render_view('insertuser', [], 'Register');
    }

    // define your other methods here
}

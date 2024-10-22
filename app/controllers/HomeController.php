<?php
require_once 'Controller.php';

class HomeController extends Controller
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
        render_view('home', [], 'Home');
    }

    // define your other methods here
}

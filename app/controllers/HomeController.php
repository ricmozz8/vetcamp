<?php
require_once 'Controller.php';
require_once 'app/models/Session.php';

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
        render_view('home', ['sessions'=>Session::all()], 'Home');
    }

    // define your other methods here
}

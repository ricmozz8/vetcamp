<?php
require_once 'Controller.php';
require_once 'app/models/Session.php';
require_once 'app/models/LimitDate.php';

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
        render_view('home', ['sessions' => Session::all(), 'limit_dates' => LimitDate::find(1)], 'Home');
    }

    // define your other methods here
}

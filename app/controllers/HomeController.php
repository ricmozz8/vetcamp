<?php
require_once 'Controller.php';
require_once 'app/models/Session.php';
require_once 'app/models/LimitDate.php';

class HomeController extends Controller
{

    /**
     * This renders the index view which shows the limit dates and the current sessions.
     *
     * @note If this is the first time the app is setting up, the limit dates need to be changed on either
     * the database or the admin panel
     * @return void
     */
    public static function index()
    {
        // Validate that the limit dates exist
        try {
            $limitDates = LimitDate::find(1);
        } catch (ModelNotFoundException $e) {
            // if they don't exist, create a temporary one with today as the start and end date.
            $limitDates = LimitDate::create(['id_date' => 1, 'start_date' => date('Y-m-d'), 'end_date' => date('Y-m-d')]);
        }

        $sessions = Session::all();

        // your index view here
        render_view('home', ['sessions' => $sessions, 'limit_dates' => $limitDates], 'Solicita para el Vetcamp ' . date('Y'));
    }

    // define your other methods here

    public static function branding()
    {
        render_view('branding', [], 'Marca');
    }

    public static function credits()
    {
        render_view('credits', [], 'Créditos');
    }
}

<?php
require_once 'Controller.php';

class BackSettingsController extends Controller
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
        render_view('backEndSettings', [], 'BackSettings');
    }

    // define your other methods here
}

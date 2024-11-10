<?php
require_once 'Controller.php';

class SettingsController extends Controller
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
        render_view('settings', [], '/admin/settings');
    }

    // define your other methods here
}

<?php
require_once 'Controller.php';
class ErrorsController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        render_view('error_log', ['errors'=>  ErrorLog::all(), 'selected' => 'errors'], 'Error Log');

    }

    // define your other methods here
}

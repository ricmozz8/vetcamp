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
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        render_view('error_log', ['errors'=>  ErrorLog::all(), 'selected' => 'errors'], 'Error Log');

    }

    public static function download()
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        $today = date('Y-m-d');
        header('Content-Type: text/plain');
        header('Content-Disposition: attachment; filename="vetcamp_error_log_' . $today . '.txt"');
        echo ErrorLog::all();
    }

    // define your other methods here
}

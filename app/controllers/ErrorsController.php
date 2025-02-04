<?php
require_once 'Controller.php';

require_once 'app/models/ErrorLog.php';

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
        // your index view here

        $errors = ErrorLog::all();

        // sorting by date (latest first)
        usort($errors, function ($a, $b) {
            return strtotime($b->throwed) - strtotime($a->throwed);
        });

        render_view('error_log', ['errors'=>  $errors, 'selected' => 'errors'], 'Error Log');

    }

    // define your other methods here
}

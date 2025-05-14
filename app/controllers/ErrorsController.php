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

        render_view('error_log', ['errors'=>  array_reverse(ErrorLog::asArray()), 'selected' => 'errors', 'space'=>Storage::get_space_data()], 'Error Log');

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
        header('Content-Transfer-Encoding: binary');
        readfile(ERROR_LOG_PATH . ERROR_LOG_FILE);
        exit;
    }

    // define your other methods here
    public static function clear()
    {
        ErrorLog::clear();
        $_SESSION['message'] = 'Error log cleared';
        redirect('/admin/dev/errors');
    }
}

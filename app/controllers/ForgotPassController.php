<?php
require_once 'Controller.php';

class ForgotPassController extends Controller
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
        render_view('forgotpass', [], 'ForgotPass');
    }

    // define your other methods here
}

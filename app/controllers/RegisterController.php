<?php
require_once 'Controller.php';

class RegisterController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                redirect('/admin');
            } else {
                redirect('/apply');
            }
        }
        // your index view here
        render_view('register', [], 'Register');
    }

    public static function insertuser()
    {
        if (Auth::check()) {
            if (Auth::user()->type == 'admin') {
                redirect('/admin');
            } else {
                redirect('/apply');
            }
        }
        render_view('insertuser', [], 'Register');
    }

    // define your other methods here
}

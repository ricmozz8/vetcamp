<?php
require_once 'Controller.php';

class RequestsController extends Controller
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
        // storing users
        $users = User::allApplicants();

        // dd(User::findLike(['first_name' => '%est%']));


        // your index view here
        render_view('requests', ["users" => $users, 'selected' => 'requests'], 'Requests');
    }

    // define your other methods here
}

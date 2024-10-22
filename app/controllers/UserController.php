<?php
require_once 'Controller.php';
require_once 'app/models/User.php';


class UserController extends Controller{

    
    /**
     * Serves the index view.
     *
     * @return void
     */
    public static function index() {
        $users = User::find(1);
        render_view('users', ['users' => $users] , 'Users');
    }
    
}
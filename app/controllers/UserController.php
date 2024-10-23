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
        $user = User::find(1);

        render_view('users', ['users' => $user] , 'Users');
    }
    
}
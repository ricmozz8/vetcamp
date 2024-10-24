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
        $userObject = User::find(3);
        

        render_view('users', ['user' => $userObject] , 'Users');
    }
    
}
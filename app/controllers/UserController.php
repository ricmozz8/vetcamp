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
        $userObject = User::find(1);
        

        render_view('users', ['user' => $userObject] , 'Users');
    }

    public static function all() {
        $users = User::all();
        dd($users);
    }

    public static function update()
    {
        $userObject = User::find(1);

        // $userObject->update(['primer_nombre' => 'Aoaoe Ie Ueaoe']);

        dd($userObject);

    }
    
}
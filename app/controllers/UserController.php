<?php
require 'Controller.php';
require 'app/models/User.php';
require __DIR__ . '/../../bootstrap/router.php';

class UserController extends Controller{

    // define your methods here
    public static function index() {
        $users = User::all();
        render_view('users', ['users' => $users]);

    }
    
}
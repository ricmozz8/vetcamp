<?php

/*
    This file is used to serve the view files.
    
    Add the view file under the `/resources/views` folder and 
    add a case under the switch below.
*/


define('VIEWS_DIR', __DIR__ . '/resources/views/');



// DEBUG ONLY ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DEBUG ONLY ---


require 'app/helpers/helpers.php';
require 'bootstrap/router.php';
require 'app/models/User.php';

// Controllers here

// --

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];
$page_title = "Vetcamp";


// Define your views/urls here
switch ($request) {

    // GET VIEWS
    case '/':
        render_view('home', ['page_title' => $page_title . ' | Home']);
        break;
    case '/users':
        $users = User::all();
        render_view('users', ['users' => $users]);
        break;

    default:
        echo '404';
        break;

    // POST VIEWS


}
?>

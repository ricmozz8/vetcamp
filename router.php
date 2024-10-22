<?php
/*
    This file is for serving the view files.
    
    Add the view file under the `/resources/views` folder and 
    add a case under the switch below.
*/


// CONTROLLERS HERE

require 'app/controllers/UserController.php';
require 'app/controllers/HomeController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Define your views/urls here
switch ($request) {

    // GET VIEWS
    case '/':
        HomeController::index();
        break;
    case '/users':
        UserController::index();
        break;
    default:
        abort(404, 'Page was not found');
        break;

    // POST VIEWS


}


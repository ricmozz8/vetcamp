<?php
/*
    This file is for serving the view files.
    
    Add the view file under the `/resources/views` folder and 
    add a case under the switch below.
*/


// CONTROLLERS HERE

require 'app/controllers/UserController.php';
require 'app/controllers/HomeController.php';
require 'app/controllers/BackDashboardController.php';
require 'app/controllers/ForgotPassController.php';
require 'app/controllers/LoginController.php';
require 'app/controllers/PassResetController.php';
require 'app/controllers/RegisterController.php';


$request =  $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Remove trailing slash
if (substr($request, -1) === '/' && $request !== '/') {
    $request = substr($request, 0, -1);
}

// Define your views/urls here
switch (strtolower($request)) {

    // GET FRONT VIEWS
    case '/':
        HomeController::index();
        break;
    case '/register':
        RegisterController::index();
        break;
    case '/login':
        LoginController::index();
        break;
    case '/forgotpass':
        ForgotPassController::index();
        break;
    case '/passreset':
        PassResetController::index();
        break;
    case '/users':
        UserController::index();
        break;
    case '/users/all':
        UserController::all();
        break;
    case '/users/update':
        UserController::update();
        break;
    case '/users/solicitants/all':
        UserController::allRegistered();
        break;

    case '/apply':
        render_view('application/dashboard', [], 'Aplica');
        break;
    case '/apply/application':
        if($method == 'POST'){
            $stage = $_POST['stage'] ?? '1';
            render_view('application/stage'.$stage  , [], 'Aplica');
        } else {
            redirect('/apply');
        }
        
        break;
    
    


    // POST FRONT VIEWS



    // GET BACK VIEWS
    case '/admin':
        echo 'WORK IN PROGRESS';
        break;
    case '/admin/profile':
        render_view('profile', [], 'Profile');
        break;
    case '/admin/backdashboard':
        BackDashboardController::index();
        break;
    default:
        abort(404, 'Page was not found');
        break;
}

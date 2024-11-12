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
require 'app/controllers/SettingsController.php';


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
    case '/register/insertuser':
        RegisterController::insertuser();
        break;
    case '/login':
        LoginController::index();
        break;
    case '/login/auth':
        LoginController::auten();
        break;
    case '/login/auth/form1':
        LoginController::form1();
        break;
    case '/login/auth/form2':
        LoginController::form2();
        break;
    case '/login/auth/form3':
        LoginController::form3();
        break;
    case '/login/auth/form4':
        LoginController::form4();
        break;
    case '/login/auth/form5':
        LoginController::form5();
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
        UserController::allApplicants();
        break;
    case '/users/new':
        UserController::new();
        break;

    case '/apply':
        render_view('application/dashboard', [], 'Aplica');
        break;
    case '/apply/application':
        // IMPORTANT: IT IS REQUIRED TO MOVE THIS TO A CONTROLLER WHEN IMPLEMENTING FUNCTIONALITY
        if($method == 'POST'){
            $stage = $_POST['stage'] ?? '1';
            render_view('application/stage'.$stage  , [], 'Aplica');
        } else {
            redirect('/apply');
        }
        
        break;
    
    // ADAPT THESE VIEWS TO SETTINGS PAGE
    case '/admin/predefmsg':
        SettingsController::editMessages();
        break;
    case '/admin/predef/update':
        SettingsController::updateMessages($method);
        break;


    // POST FRONT VIEWS
    


    // GET BACK VIEWS
    case '/admin':
        BackDashboardController::index();
        break;
    case '/admin/profile':
        render_view('profile', [], 'Profile');
        break;
    case '/admin/requests':
        render_view('requests', [], 'Requests');
        break;
    case '/admin/registered':
        render_view('registered', [], 'Registered');
        break;
    case '/admin/settings':
        render_view('settings', [], 'Settings');
        break;
    default:
        abort(404, 'Page was not found');
        break;
}

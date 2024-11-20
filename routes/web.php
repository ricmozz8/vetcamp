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
require 'app/controllers/RegisteredController.php';
require 'app/controllers/RequestsController.php';
require 'app/controllers/SessionController.php';
require 'app/controllers/EvaluateController.php';
require 'app/controllers/TrackingController.php';
require 'app/controllers/ApplicationController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$parsedUrl = parse_url($request);
$path = strtolower($parsedUrl['path']);
$queryParams = [];
parse_str($parsedUrl['query'] ?? '', $queryParams); // Parse query string into an associative array


// Remove trailing slash
if (substr($request, -1) === '/' && $request !== '/') {
    $request = substr($request, 0, -1);
}

// Define your views/urls here
switch ($path) {

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
        LoginController::authenticate($method);
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
    case '/admin':
        BackDashboardController::index();
        break;
    case '/admin/profile':
    case '/admin/requests/r':
        $application_id = $_GET['id'] ?? null;
        ApplicationController::editApplication($application_id);
        break;
    case '/admin/requests/update':
        ApplicationController::updateStatus($method);
        break;
    case '/admin/requests':
        RequestsController::index();
        break;
    case '/admin/registered':
        RegisteredController::index();
        break;
    case '/admin/settings':
        SettingsController::index();
        break;
    case '/admin/settings/e/approved':
        SettingsController::updateMessage($method);
        break;
    case '/admin/settings/e/rejected':
        SettingsController::updateMessage($method);
        break;
    case '/admin/settings/e/all':
        SettingsController::updateMessage($method);
        break;
    case '/admin/settings/e/dates':
        SettingsController::updateLimitDate($method);
        break;
    case '/admin/update': # need correct url
        SessionController::updateSession($method);
        break;    
    case '/admin/profile/track': # need correct url
        TrackingController::TrackingEvaluation($method);
        break;
    default:
        abort(404, 'Page was not found');
        break;
}

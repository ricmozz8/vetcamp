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
require 'app/controllers/AuthController.php';
require 'app/controllers/SettingsController.php';
require 'app/controllers/RegisteredController.php';
require 'app/controllers/RequestsController.php';
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
        AuthController::register();
        break;
    case '/register/new':
        AuthController::registerUser($method);
        break;
    case '/login':
        AuthController::login();
        break;
    case '/login/auth':
        AuthController::loginUser($method);
        break;
    case '/forgotpass':
        AuthController::forgotPassword();
        break;
    case '/passreset':
        AuthController::resetPassword();
        break;
    case '/logout':
        AuthController::logoutUser();
        break;
    case '/apply':
        ApplicationController::index();
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
    case '/sessions/update':
        SettingsController::updateSession($method);
        break;
    case '/sessions/create':
        SettingsController::updateSession($method);
        break;
    case '/admin/profile/track': # need correct url
        TrackingController::TrackingEvaluation($method);
        break;
    default:
        abort(404, 'Page was not found');
        break;
}

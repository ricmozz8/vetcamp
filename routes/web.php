<?php
/*
    This file is for serving the view files.
    
    Add the view file under the `/resources/views` folder and 
    add a case under the switch below.
*/


// CONTROLLERS HERE



require 'app/controllers/FileController.php';
require 'app/controllers/HomeController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$parsedUrl = parse_url($request);
$path = strtolower($parsedUrl['path']);
$queryParams = [];
parse_str($parsedUrl['query'] ?? '', $queryParams); // Parse query string into an associative array



// Define your views/urls here
require 'auth.php';
require 'application.php';
require 'admin.php';

require_once 'app/controllers/UserApplicationController.php';

switch ($path) {

        // GET FRONT VIEWS
    case '/':
        HomeController::index();
        break;

    case '/solicitud':
        UserApplicationController::getPrintableApplication();
        break;

    case '/branding':
        HomeController::branding();
        break;
    case '/credits':
        HomeController::credits();
        break;
    case '/terms':
        HomeController::terms();
        break;
    case '/profile/update':
        UserController::update($method);
        break;
    case '/fatal':
        render_view('fatal', [], '¡Oh no!');
        break;

    default:
        abort(404, 'Page was not found');
        break;
}

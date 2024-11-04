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
require 'app/controllers/BackSettingsController.php';
require 'app/controllers/BackApplicationsController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

// Define your views/urls here
switch ($request) {

    // GET FRONT VIEWS
    case '/':
        HomeController::index();
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


    // POST FRONT VIEWS



    // GET BACK VIEWS
    case '/admin':
        echo 'WORK IN PROGRESS';
        break;
    case '/BackDashboard':
        BackDashboardController::index();
        break;
    case '/BackSettings':
        BackSettingsController::index();
        break;
    case '/BackApplications':
        BackApplicationsController::index();
        break;
    default:
        abort(404, 'Page was not found');
        break;
}

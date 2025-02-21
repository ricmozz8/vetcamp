<?php
require_once 'app/controllers/AuthController.php';
require_once 'app/controllers/UserController.php';


switch ($path) {
    case '/register':
        AuthController::register();
        break;
    case '/register/new':
        AuthController::registerUser($method);
        break;
    case '/login':
        AuthController::login($method);
        break;
    case '/forgotpass':
        AuthController::forgotPassword();
        break;
    case '/restablish':
        AuthController::resetPassword();
        break;
    case '/passreset':
        AuthController::changePassword();
        break;
    case '/logout':
        AuthController::logoutUser($method);
        break;
    case '/check-last-login':
        AuthController::checkLastLogin();
        break;
    case '/profile':
        UserController::edit($method);
        break;
    case '/profile/password/change':
        UserController::passwordChange($method);
        break;
    case '/profile/phone/update':
        UserController::change('phone', $method);
        break;
    case '/profile/physical/update':
        UserController::change('physical', $method);
        break;
    case '/profile/postal/update':
        UserController::change('postal', $method);
        break;
    case '/profile/school/update':
        UserController::change('school', $method);
        break;
    case '/profile/u/delete':
        UserController::destroy($method);
        break;
    case '/profile/a/rescind':
        UserController::rescindApplication($method);
        break;
}
<?php
require 'app/controllers/AuthController.php';

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
    }
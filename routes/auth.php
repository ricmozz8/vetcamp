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
    case '/passreset':
        AuthController::resetPassword();
        break;
    case '/logout':
        AuthController::logoutUser($method);
        break;
    }
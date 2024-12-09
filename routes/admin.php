<?php
require 'app/controllers/UserController.php';

require 'app/controllers/BackDashboardController.php';

require 'app/controllers/SettingsController.php';
require 'app/controllers/RegisteredController.php';
require 'app/controllers/RequestsController.php';

require 'app/controllers/TrackingController.php';
require 'app/controllers/ApplicationController.php';
require 'app/controllers/AcceptedController.php';

switch ($path) {
    case '/admin':
        BackDashboardController::index();
        break;
    case '/admin/create':
        SettingsController::createAdmin($method);
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
    case '/admin/accepted':
        AcceptedController::index();
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
    case '/admin/profile/track': # need correct url
        TrackingController::TrackingEvaluation($method);
        break;
    case '/admin/delete/rejected/requests':
        SettingsController::deleteRejectedRequests($method);
        break;
    case '/sessions/update':
        SettingsController::updateSession($method);
        break;
    case '/sessions/create':
        SettingsController::updateSession($method);
        break;
    case '/profile/update':
        UserController::update($method);
        break;
}

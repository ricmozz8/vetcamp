<?php
require_once 'app/controllers/UserController.php';

require_once 'app/controllers/BackDashboardController.php';

require_once 'app/controllers/SettingsController.php';
require_once 'app/controllers/RegisteredController.php';
require_once 'app/controllers/RequestsController.php';

require_once 'app/controllers/TrackingController.php';
require_once 'app/controllers/ApplicationController.php';
require_once 'app/controllers/AcceptedController.php';

require_once 'app/controllers/MessagesController.php';
require_once 'app/controllers/CommentController.php';
require_once 'app/controllers/ErrorsController.php';
require_once 'app/controllers/UserController.php';
require_once 'app/controllers/DocumentController.php';

require_once 'app/controllers/AuditController.php';


if (strpos($path, '/admin') === 0) {

    // the user is not logged in
    if (!Auth::check()) {
        redirect('/login');
    }

    // the user is not an admin
    if (Auth::user()->type !== 'admin') {
        redirect('/apply');
    }
}

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
    case '/admin/settings/archive':
        ApplicationController::archive();
        break;
    case '/admin/requests':
        RequestsController::index($method);
        break;
    case '/admin/registered':
        RegisteredController::index();
        break;
    case '/admin/registered/changestatus':
        RegisteredController::changeStatus($method);
        break;
    case '/admin/p':
        $userId = $_GET['user'] ?? null;
        $from = $_GET['from'] ?? null;
        UserController::details($userId, $from, $method);
        break;
    case '/admin/m':
        UserController::message($method);
        break;
    case '/admin/accepted':
        AcceptedController::index();
        break;
    case '/admin/settings':
        SettingsController::index();
        break;
    case '/admin/settings/e/rejected':
    case '/admin/settings/e/all':
    case '/admin/settings/e/approved':
        SettingsController::updateMessage($method);
        break;
    case '/admin/settings/e/dates':
        SettingsController::updateLimitDate($method);
        break;
    case '/admin/requests/track':
        TrackingController::TrackingEvaluation($method);
        break;
    
    case '/admin/settings/editpicture':
        SettingsController::editPictureInHomePage($method);
        break;

    case '/admin/requests/download':
        ApplicationController::download($method);
        break;
    case '/admin/delete/rejected/requests':
        SettingsController::deleteRejectedRequests($method);
        break;
    case '/admin/delete/all/requests':
        SettingsController::deleteAllRequests($method);
        break;
    case '/admin/delete/application':
        ApplicationController::deleteApplication($method);
        break;
    case '/sessions/create':

    case '/sessions/update':
        SettingsController::updateSession($method);
        break;
    case '/admin/dev/errors':
        ErrorsController::index();
        break;
    case '/admin/dev/errors/download':
        ErrorsController::download();
        break;
    case '/admin/audit':
        AuditController::index($method);
        break;

    case '/admin/audit/download':
        AuditController::download();
        break;
    // document admin provider

    case '/admin/document':
        $application = $_GET['a'] ?? null;
        $document = $_GET['d'] ?? null;
        DocumentController::index($application, $document);
        break;
    
    // enroll

    case '/admin/enroll':
        AcceptedController::enroll($method);
        break;

    case '/admin/enroll/auto':
        AcceptedController::autoEnroll($method);
        break;

    case '/admin/error/clear':
        ErrorsController::clear();
        break;
    case '/users/delete':
        UserController::delete($method);
        break;

    case '/mail':
        MessagesController::mailUsers($method);
        break;
    case '/mail/user':
        MessagesController::message($method);
        break;
    case '/admin/registered/export-to-csv':
        RegisteredController::downloadCsvUsers();
        break;
    case '/admin/requests/export-to-csv':
        RequestsController::downloadCsvApplications();
        break;

    //  COMMENT SECTION

    case '/admin/request/comment':
        ApplicationController::comment($method);
        break;

    case '/admin/comment/update':
        CommentController::manage($method, 'update');
        break;

    case '/admin/comment/delete':
        CommentController::manage($method, 'destroy');
        break;
}

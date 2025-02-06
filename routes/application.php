<?php
require 'app/controllers/UserApplicationController.php';


switch ($path) {
    case '/apply':
        UserApplicationController::index();
        break;
    case '/apply/application':
        redirect('/apply/application/basic_info');
    case '/apply/application/basic_info':
        UserApplicationController::basic_data($method);
        break;
    case '/apply/application/contact':
        UserApplicationController::contact($method);
        break;
    case '/apply/application/documents':
        UserApplicationController::documents($method);
        break;
    case '/apply/application/confirm':
        UserApplicationController::confirm($method);
        break;
}

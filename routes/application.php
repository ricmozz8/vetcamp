<?php
switch ($path) {
    case '/apply':
        UserApplicationController::index();
        break;
    case '/apply/application':
        redirect('/apply/application/basic_info');
    case '/apply/application/basic_info':
        UserApplicationController::basic_data($method);
    case '/apply/application/contact':
        UserApplicationController::contact($method);
    case '/apply/application/documents':
        UserApplicationController::documents($method);
    case '/apply/application/confirm':
        UserApplicationController::confirm($method);
}

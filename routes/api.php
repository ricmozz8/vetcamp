<?php
require_once 'app/controllers/ApiController.php';

$request = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$parsedUrl = parse_url($request);
$path = strtolower($parsedUrl['path']);

switch ($path) {
    case '/api/v1/users/stats':
        ApiController::userStats();
        break;
    case '/api/v1/requests/stats':
        ApiController::requestStats();
        break;
    case '/api/v1/server/status':
        ApiController::serverStatus();
        break;
    case '/api/v1/dates':
        ApiController::dates();
        break;
    default:
        header('Content-Type: application/json');
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint not found']);
        break;
}

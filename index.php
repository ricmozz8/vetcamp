<?php

/*
    This file is used to serve the view files.
    
    Add the view file under the `/resources/views` folder and 
    add a case under the switch below.
*/


// DEBUG ONLY ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DEBUG ONLY ---



require 'app/helpers/helpers.php';

$request = $_GET['q'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];


define('VIEWS_DIR', __DIR__ . '/resources/views/');





$page_title = "Vetcamp";


// Define your views/urls here
switch ($request) {

    // GET VIEWS

    case '':
        // customizing the page title
        $page_title .= ' | Home';

        // serving the view
        include VIEWS_DIR . 'home.php';
        break;


    case 'about':
        include VIEWS_DIR . 'about.php';
        break;
    case 'contact':
        include VIEWS_DIR . 'contact.php';
        break;
    default:
        include VIEWS_DIR . '404.php';
        break;

    // POST VIEWS


}
?>

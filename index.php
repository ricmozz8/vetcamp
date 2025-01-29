<?php

// setting upload max size to 25MB
ini_set('upload_max_filesize', '25M');
ini_set('post_max_size', '25M');
ini_set('max_execution_time', 50000);



/**
 * 
 * Main Application Bootstrapper
 * 
 * This is the main entry point of the application, it will import all the required files
 * and start the application.
 */



// GLOBAL IMPORTS AVAILABLE ON ALL FILES
require 'app/helpers/helpers.php';
require 'bootstrap/exceptions.php';
require 'kernel/auth.php';
require 'mailing/mailer.php';
require 'storage/Storage.php';


// 8388608 is 8MB, we are setting the maximum POST size to 8MB
// 11379602 is 10MB
if ($_SERVER['REQUEST_METHOD'] === 'POST' && empty($_POST) && $_SERVER['CONTENT_LENGTH'] > 8388608) {
    die('Request too large');

}


session_start();


// setting the locale and time
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('America/Puerto_Rico');

// Let the router handle all requests

Auth::checkLastLogin(); // fix this (currently broken)
include 'routes/web.php';

?>

<?php

// setting upload max size to 25MB
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



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
require 'kernel/ErrorLog.php';




session_start();


// setting the locale and time
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('America/Puerto_Rico');

// Let the router handle all requests

Auth::checkLastLogin(); // fix this (currently broken)
include 'routes/web.php';

?>

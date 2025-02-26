<?php


/**
 * 
 * Main Application Bootstrapper
 * 
 * This is the main entry point of the application, it will import all the required files
 * and start the application.
 */



// GLOBAL IMPORTS AVAILABLE ON ALL FILES
require 'app/helpers/helpers.php';
require 'kernel/ErrorLog.php';
require 'bootstrap/exceptions.php';
require 'kernel/auth.php';
require 'mailing/mailer.php';
require 'storage/Storage.php';



session_start();


// setting the locale and time
setlocale(LC_TIME, 'es_ES.UTF-8');
date_default_timezone_set('America/Puerto_Rico');

// Let the router handle all requests
Storage::check_free();


include 'routes/web.php';



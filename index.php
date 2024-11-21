<?php
// DEBUG ONLY ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DEBUG ONLY ---

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

session_start();

// Let the router handle all requests
include 'routes/web.php';

?>

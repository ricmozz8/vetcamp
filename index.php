<?php
// DEBUG ONLY ---
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// DEBUG ONLY ---

// GLOBAL IMPORTS REQUIRED IN ALL FILES
require 'app/helpers/helpers.php';
require 'bootstrap/exceptions.php';
require 'kernel/auth.php';
require 'mailing/mailer.php';



// Let the router handle all requests
include 'router.php';

?>

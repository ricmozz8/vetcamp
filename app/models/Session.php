<?php
require_once 'Model.php';

class Session extends Model{

   // define your methods here
    protected static $primary_key = 'session_id';
    protected static $table = 'sessions';

    
}
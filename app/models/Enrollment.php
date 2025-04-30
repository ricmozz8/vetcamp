<?php
require_once 'Model.php';
require_once 'User.php';
require_once 'Session.php';

class Enrollment extends Model{

    // define your methods here
    protected static $table = 'enrollments';
    protected static $primary_key = 'user_id';

}
<?php
require_once 'Model.php';
require_once 'User.php';
require_once 'Session.php';
require_once 'Application.php';

class Enrollment extends Model{

    // define your methods here

    protected static $table = 'enrollment';
    protected  static $hidden = ['session_id','made_on'];
    protected static $primary_key = 'user_id';


    public function construct(array $attributes, array $sanitized) {
        parent::__construct($attributes, $sanitized);
    }

    public static function getCurrentApplicants($user_id) 
    {
       return User::approvedApplicants($user_id);
    }

}
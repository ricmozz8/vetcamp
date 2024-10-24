<?php
require_once 'Model.php';
require_once 'Application.php';

class User extends Model{

    // define your methods here
    // protected static $table = 'usuarios'; // change here the table name
    protected static $hidden = ['password', 'status', 'user_id'];
    protected static $primary_key = 'user_id';

    public function __construct(array $attributes, array $sanitized){
        parent::__construct($attributes, $sanitized);
    }


    public function get_values(){
        return $this->values;
    }

    // relationships
    
    /**
     * Finds the application that belongs to the user
     * 
     * @return Application The application instance
     */
    public function application()
    {
        if (!isset($this->attributes[self::$primary_key])) {
            return null;
        }
        return Application::find($this->attributes[self::$primary_key], self::$primary_key);
    }




}
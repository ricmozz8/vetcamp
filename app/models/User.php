<?php
require_once 'Model.php';
require_once 'Application.php';

class User extends Model{

    // define your methods here
    // protected static $table = 'usuarios'; // change here the table name
    protected static $hidden = ['contrasena', 'estado', 'id_usuario'];
    protected static $primary_key = 'id_usuario';

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
        return Application::find($this->attributes[self::$primary_key], self::$primary_key);
    }




}
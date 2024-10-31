<?php
require_once 'Model.php';
require_once 'Application.php';

class User extends Model{

    // define your methods here
    // protected static $table = 'usuarios'; // change here the table name
    protected static $hidden = ['password', 'user_id'];
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

    public static function allRegistered() {
        try {
            $users = self::all(); // Recupera todos los usuarios
            $applications = Application::all(); // Recupera todas las aplicaciones
            $applicationsByUserId = [];
    
            // Organiza las aplicaciones por user_id para un acceso rápido
            foreach ($applications as $application) {
                $applicationsByUserId[$application->user_id] = $application;
            }
    
            $result = []; // Resultado final
    
            foreach ($users as $user) {
                try {
                    $userApplication = $user->application();
                    
                    // Verifica si el usuario tiene una aplicación y asigna el estado
                    if ($userApplication) {
                        $user->status = $userApplication->status;
                        $result[] = $user;
                    }
                } catch (ModelNotFoundException $notFound) {
                    continue;
                }
            }
            return $result;
    
        } catch (Exception $e) {
            throw new Exception("An error occurred: " . $e->getMessage());
        }
    }




}
<?php
require_once 'Model.php';
require_once 'Application.php';

class User extends Model{

    protected static $hidden = ['password', 'user_id']; // Attributes that should not be serialized
    protected static $primary_key = 'user_id'; // The primary key of the model

    /**
     * Initializes a new instance of the User class
     * 
     * @param array $attributes The attributes of the user
     * @param array $sanitized The sanitized values of the user
     */
    public function __construct(array $attributes, array $sanitized){
        parent::__construct($attributes, $sanitized);
    }


    /**
     * Returns the sanitized values of the user model
     * 
     * @return array An associative array with the sanitized values of the user
     */
    public function get_values(){
        return $this->values;
    }
    
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

    /**
     * Finds all registered users.
     *
     * This method returns all registered users and their
     * application status. Users without an application are
     * not included in the result.
     *
     * @return User[] An array of User objects with the "status" attribute
     *                filled with the application status if any.
     *
     * @throws Exception If an error occurs while fetching the users or
     *                   applications.
     */
    public static function allRegistered() {
        try {
            $users = self::all();
            $applications = Application::all(); 
            $applicationsByUserId = [];
    
            
            foreach ($applications as $application) {
                $applicationsByUserId[$application->user_id] = $application;
            }
    
            $result = []; 
    
            foreach ($users as $user) {
                try {
                    $userApplication = $user->application();
                    
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
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

   
    public static function allApplicants() {
        try {
            $type = 'user';
            $users = self::allof($type);
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

    /**
     * Retrieves all users of the given type from the database.
     *
     * This method works the same way as the parent class's all() method, but
     * it filters the results to only include users of the given type.
     *
     * @param string $type The type of users to retrieve. The only valid
     *                     value currently is 'user', but more types may
     *                     be added in the future.
     *
     * @return User[] An array of User objects of the given type.
     *
     * @throws Exception If an error occurs while fetching the users.
     */
    public static function allof(string $type){
        $all_users = parent::all();
        $filtered_users = array_filter($all_users, function ($user) use ($type) {
            return $user->type === $type;
        });
        return $filtered_users;
    }

    /**
     * Retrieves all approved users from the database.
     *
     * This method queries the database to fetch all users whose status is 'approved'.
     *
     * @return User[] An array of User objects whose applications were approved.
     *
     * @throws Exception If an error occurs while fetching the users.
     */
    public static function getApprovedUsers()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE status = 'approved'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Retrieves all denied users from the database.
     *
     * This method queries the database to fetch all users whose status is 'denied'.
     *
     * @return User[] An array of User objects whose applications were denied.
     *
     * @throws Exception If an error occurs while fetching the users.
     */
    public static function getDeniedUsers()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE status = 'denied'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

}
<?php
require_once 'Model.php';
require_once 'Application.php';
require_once 'SchoolAddress.php';
require_once 'PostalAddress.php';
require_once 'PhysicalAddress.php';

class User extends Model
{
    protected static $table = 'users';
    protected static $hidden = ['password', 'user_id']; // Attributes that should not be serialized
    protected static $primary_key = 'user_id'; // The primary key of the model

    /**
     * Initializes a new instance of the User class
     * 
     * @param array $attributes The attributes of the user
     * @param array $sanitized The sanitized values of the user
     */
    public function __construct(array $attributes, array $sanitized)
    {
        parent::__construct($attributes, $sanitized);
    }


    /**
     * Sends an email to the user with the given message
     * 
     * @param string $message The message to send to the user
     * @return void
     */
    public function sendEmail($message)
    {
        Mailer::send($this->email, 'Mensaje de Vetcamp', $message);
    }


    /**
     * Returns the sanitized values of the user model
     * 
     * @return array An associative array with the sanitized values of the user
     */
    public function get_values()
    {
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
        try {
            $apply = Application::find($this->attributes[self::$primary_key], self::$primary_key);
        } catch (ModelNotFoundException $notFound) {
            return null;
        }

        return  $apply;
    }

    
    /**
     * This returns a list of users that have not yet submitted an application (interested in applying).
     */
    public static function interested()
    {
        try {
            $users = self::allof('user');

            $interested_list = [];

            foreach ($users as $user) {
                try {
                    $application = $user->application();

                    if ($application === null || !($application->isComplete())) {
                        $interested_list[] = $user;
                    }
                } catch (ModelNotFoundException $notFound) {
                    continue;
                }
            }
        } catch (Exception $e) {
            throw new Exception("An error occurred: " . $e->getMessage());
        }

        return $interested_list;
    }


    public static function allApplicants()
    {
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


                    // including applications that have been submitted
                    if ( $userApplication !== null && $userApplication->isComplete()) {
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
    public static function allof(string $type)
    {
        $all_users = parent::all();
        $filtered_users = array_filter($all_users, function ($user) use ($type) {
            return $user->type === $type;
        });
        return $filtered_users;
    }


    /**
     * Retrieves the school address associated with the user.
     *
     * This method queries the SchoolAddress model to find the address
     * record linked to the user based on the primary key.
     *
     * @return SchoolAddress|null The SchoolAddress instance associated
     *                            with the user, or null if not found.
     */
    public function school_address()
    {
        try {
            return SchoolAddress::find($this->attributes[self::$primary_key], self::$primary_key);
        } catch (ModelNotFoundException $notFound) {
            return null;
        }
    }


    /**
     * Retrieves the postal address associated with the user.
     *
     * This method queries the PostalAddress model to find the address
     * record linked to the user based on the primary key.
     *
     * @return PostalAddress|null The PostalAddress instance associated
     *                            with the user, or null if not found.
     */
    public function postal_address()
    {
        try {
            return PostalAddress::find($this->attributes[self::$primary_key], self::$primary_key);
        } catch (ModelNotFoundException $notFound) {
            return null;
        }
    }

    /**
     * Retrieves the physical address associated with the user.
     *
     * This method queries the PhysicalAddress model to find the address
     * record linked to the user based on the primary key.
     *
     * @return PhysicalAddress|null The PhysicalAddress instance associated
     *                              with the user, or null if not found.
     */
    public function physical_address()
    {
        try {
            return PhysicalAddress::find($this->attributes[self::$primary_key], self::$primary_key);
        } catch (ModelNotFoundException $notFound) {
            return null;
        }
    }


    public function get_age()
    {
        $birth_date = new DateTime($this->birthdate);
        $current_date = new DateTime(date('Y-m-d'));
        $interval = $birth_date->diff($current_date);
        return $interval->y;
    }
}

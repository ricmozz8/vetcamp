<?php
require_once 'Model.php';
require_once 'app/models/User.php';


/**
 * The Audit class extends the Model class and represents an audit record in the system.
 * It provides functionalities for tracking user actions such as 'create', 'update', and 'delete'.
 * 
 * This class interacts with the 'audits' table in the database, storing details of actions performed by users.
 * It includes methods for registering new audit entries, ensuring actions are within the allowed set of actions.
 */

class Audit extends Model{

    protected static $table = "audits";
    protected static $primary_key = "id";

    const ALLOWED_ACTIONS = [
        'update',
        'delete',
        'create',
    ];


    /**
     * Registers a new audit entry in the database.
     *
     * @param string $summary A brief description of the action performed.
     * @param string $action The action performed. Must be one of the following: 'update', 'delete', 'create'.
     * @return bool True if the audit entry is successfully created, false otherwise.
     */
    public static function register(string $summary, string $action): bool{

        if(!Auth::check())
            return false;

        if(!in_array($action, self::ALLOWED_ACTIONS))
            return false;

        self::create([
            'summary' => $summary,
            'user_id' => Auth::user()->user_id,
            'action' => $action
        ]);

        return true;
    }

    /**
     * Retrieves the user associated with this audit entry.
     *
     * @return User|null The User model if found, or null if no user exists with the given user_id.
     * @throws Exception If the user_id is not found in the database.
     */

    public function user(){
        return User::find($this->attributes['user_id']);
    }


}
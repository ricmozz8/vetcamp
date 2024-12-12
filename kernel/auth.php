<?php 
require_once 'app/models/User.php';
class Auth
{

    private function __construct() {} // prevent instantiation

    /**
     * Set the user as logged in, and store it in the session
     * @param array $user The user to be logged in
     */
    public static function login(User $user){

        // if trying to login with a user that is already logged in
        $_SESSION['user'] = $user;
    }

    /**
     * Unset the user as logged in, and remove it from the session
     */
    public static function logout(){

        // if trying to logout when not logged in
        if (!isset($_SESSION['user'])) return;
        session_destroy();
    }

    /**
     * Check if the user is logged in
     * @return bool True if the user is logged in, false otherwise
     */
    public static function check(){
        return isset($_SESSION['user']);
    }

    /**
     * Get the user currently logged in
     * @return User|null The user if logged in, null otherwise
     */
    public static function user()
    {
        if (!isset($_SESSION['user'])) return null;

        return User::find($_SESSION['user']->__get('user_id'), 'user_id');
    }

    /**
     * Refreshes the user in the session with the latest data from the database.
     * If the user is not logged in, this method does nothing.
     */
    public static function refresh()
    {
        if (isset($_SESSION['user'])) {
            $_SESSION['user'] = User::find($_SESSION['user']->__get('user_id'));
            return True;
        }
        return False;
    }

    /**
     * Check if the user currently logged in is an admin
     * @return bool True if the user is an admin, false if not logged in or not an admin
     */
    public static function is_admin(){
        if (!self::check()) {
            return False;
        }

        return self::user()->type == 'admin';
    }


    /**
     * If the user is not logged in, redirects to /login.
     * If the user is an admin, redirects to /admin.
     * If the user is not an admin, redirects to /apply.
     */
    public static function only_logged_in(){
        if (!self::check()) {
            redirect('/login');
        } 

        if (self::user()->type == 'admin') {
            redirect('/admin');
        } else {
            redirect('/apply');
        }
    }
    

    
}
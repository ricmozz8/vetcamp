<?php 
class Auth
{

    public static $user = null;

    private function __construct() {} // prevent instantiation

    /**
     * Set the user as logged in, and store it in the session
     * @param array $user The user to be logged in
     */
    public static function login($user){

        // if trying to login with a user that is already logged in
        if(isset($_SESSION['user'])) return;

        session_start();

        $_SESSION['user'] = true;
        self::$user = $user;
    }

    /**
     * Unset the user as logged in, and remove it from the session
     */
    public static function logout(){

        // if trying to logout when not logged in
        if (!isset($_SESSION['user'])) return;
        session_abort();
        unset($_SESSION['user']);
        self::$user = null;
    }

    /**
     * Check if the user is logged in
     * @return bool True if the user is logged in, false otherwise
     */
    public static function check(){
        return isset($_SESSION['user']);
    }
}
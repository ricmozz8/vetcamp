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
        $_SESSION['user'] = $user;
        self::$user = $user;
    }

    /**
     * Unset the user as logged in, and remove it from the session
     */
    public static function logout(){
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
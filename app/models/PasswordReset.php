<?php
require_once 'Model.php';

class PasswordReset extends Model{

    // define your methods here
    protected static $table = 'password_resets';
    protected static $primary_key = 'id';

    private $defaultTTL = 1; // 1 day



    /**
     * Generates a random 20 character string based on the current microtime and an optional seed.
     * This is used for generating password reset tokens.
     *
     * @param string $seed An optional seed to add to the md5 hash.
     * @return string A 20 character string token.
     */
    public static function generateToken($seed = ''){
        return substr(str_shuffle(md5($seed . microtime())), 0, 20);
    }


    
    /**
     * Generates a 6-digit one-time password (OTP) using the current microtime and an optional seed.
     *
     * @param string $seed An optional seed to add to the md5 hash.
     * @return string A 6-digit OTP.
     */

    public static function generateOTP($seed = ''){
        return substr(str_shuffle(md5($seed . microtime())), 0, 6);
    }


    /**
     * @return int
     */
    public function getDefaultTTL()
    {
        return $this->defaultTTL;
    }

    /**
     * @param int $defaultTTL
     */
    public function setDefaultTTL($defaultTTL)
    {
        $this->defaultTTL = $defaultTTL;
    }



}
<?php
require_once 'Model.php';

class ReactiveAccount extends Model{

    // define your methods here
    protected static $table = 'reactive_useraccount';
    protected static $primary_key = 'id';


    /**
     * Generates a 6-digit one-time password (OTP) using the current microtime and an optional seed.
     *
     * @param string $seed An optional seed to add to the md5 hash.
     * @return string A 6-digit OTP.
     */

    public static function generateOTP($seed = ''){
        return substr(str_shuffle(md5($seed . microtime())), 0, 6);
    }
}
<?php
require_once 'Model.php';

class Session extends Model{

   // define your methods here
    protected static $primary_key = 'session_id';
    protected static $table = 'sessions';


    /**
     * Return a human-readable string representing the session.
     *
     * @example 'Sesión 1 (20 al 24 de junio)'
     *
     * @return string
     */
    public function formatted()
    {
        return $this->title . ' (' . get_date_spanish($this->start_date, false, false) . ' al ' . get_date_spanish($this->end_date) . ')';
    }
    
}
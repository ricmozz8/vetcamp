<?php
require_once 'Model.php';
require_once 'User.php';

class Application extends Model{

    protected static $primary_key = 'id_application'; // Primary key
    protected static $table = 'applications'; // Table

    public function preferred_session($human_readable = false)
    {

        $session = Session::find($this->attributes['id_preferred_session'], 'session_id');

        if ($human_readable) {
            return $session->title . ' (' . $session->start_date . ' - ' . $session->end_date . ')';
        }

        return $session;
    }

    public function documentCount()
    {
        $count = 0;
        
        foreach ($this->attributes as $key=>$value) 
        {
            if (strpos($key, 'url') !== false and $value != null) 
            {
                $count++;
            }
        }

        return $count;
    }

}
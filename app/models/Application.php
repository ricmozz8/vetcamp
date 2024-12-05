<?php
require_once 'Model.php';
require_once 'User.php';

class Application extends Model{

    protected static $primary_key = 'id_application'; // Primary key
    protected static $table = 'applications'; // Table
    public static $statusParsings = [
        'unsubmitted' => 'Sin llenar',
        'submitted' => 'Sometida',
        'need_changes' => 'Necesita Cambios',
        'approved' => 'Aceptado',
        'denied' => 'Rechazado',
        'incomplete' => 'Incompleta'
    ];

    public function __construct(array $attributes, array $sanitized)
    {
        parent::__construct( $attributes,  $sanitized);
        $this->status = self::$statusParsings[$this->status];
    }

    public function preferred_session($human_readable = false)
    {

        $session = Session::find($this->attributes['id_preferred_session'], 'session_id');

        if ($human_readable) {
            return $session->title . ' (' . get_date_spanish($session->start_date, false, false) . ' al ' . get_date_spanish($session->end_date) . ')';
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
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

    /**
     * Retrieves the preferred session of the application.
     * 
     * If the second argument is true, the method will return a human-readable string
     * containing the title of the session and the start and end dates of the session.
     * If the second argument is false, the method will return an object of class Session.
     * 
     * @param boolean $human_readable If true, returns a human-readable string. If false, returns a Session object.
     * @return string|Session Depending on the value of $human_readable.
     */
    public function preferred_session($human_readable = false)
    {

        $session = Session::find($this->attributes['id_preferred_session'], 'session_id');

        if ($human_readable) {
            return $session->title . ' (' . get_date_spanish($session->start_date, false, false) . ' al ' . get_date_spanish($session->end_date) . ')';
        }

        return $session;
    }

    /**
     * Counts the number of documents uploaded by the user in the application.
     * 
     * @return int The number of uploaded documents.
     */
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

   
    
    
    /**
     * Deletes all denied user requests and the users themselves ( from the list of solicitants).
     * 
     * Iterates over all applicants and checks if the application status is 'denied'. If so, it calls the delete() method on the Application model.
     * 
     * @return array An array of the deleted user IDs.
     */
    public function UserisDeniedDeletion() {
        $users = User::allApplicants();
        $deletedApplications = [];
    
        foreach ($users as $user) 
        {
            $application = $user->application();
    
            if ($application && $application->status === 'denied') {
                $deniedUsers = $application->delete();
                $deletedApplications[] = $deniedUsers;
            }
        }
        return $deletedApplications;
    }
}
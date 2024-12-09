<?php
require_once 'Model.php';
require_once 'User.php';

class Application extends Model
{

    protected static $primary_key = 'id_application'; // Primary key
    protected static $table = 'applications'; // Table name
    
    public static $statusParsings = [
        'unsubmitted' => 'Sin llenar',
        'submitted' => 'Sometida',
        'need_changes' => 'Necesita Cambios',
        'approved' => 'Aceptado',
        'denied' => 'Rechazado',
        'incomplete' => 'Incompleta',
        'waitlist' => 'En lista de espera'
    ];

    public function __construct(array $attributes, array $sanitized)
    {
        parent::__construct($attributes,  $sanitized);
        $this->status = self::$statusParsings[$this->status];
    }

    /**
     * Retrieves the user associated with the application.
     *
     * @return User The user that made the application.
     */
    public function user()
    {
        return User::find((int) $this->attributes['user_id'], 'user_id', 'users');
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

        foreach ($this->attributes as $key => $value) {
            if (strpos($key, 'url') !== false and $value != null) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * Given a status in Spanish, returns the corresponding status in English.
     * 
     * @param string $statusInSpanish The status in Spanish.
     * @return string The status in English. If the status in Spanish is not found, returns the input string.
     */
    public static function getStatusInEnglish($statusInSpanish)
{
    $reverseParsing = array_flip(self::$statusParsings); 
    return $reverseParsing[$statusInSpanish] ?? $statusInSpanish;
}
   



    /**
     * Deletes all denied user requests.
     * 
     * @return array An array of user IDs of the users whose requests were deleted.
     */
    public function UserisDeniedDeletion()
    {
        $users = User::allApplicants();
        $deletedApplications = [];

        foreach ($users as $user) {
            $application = $user->application();

            if ($application) 
            {
                $statusInEnglish = self::getStatusInEnglish($application->status);
            }
            if ($statusInEnglish === 'denied') 
            {
                $application->delete();
                $deletedApplications[] = $user->user_id;
            }
        }
    
    return $deletedApplications;
}

    /**
     * Deletes all user requests.
     * 
     * @return array An array of user IDs of the users whose requests were deleted.
     */
    public function DeletionOfAllApplications()
    {
        $users = User::allApplicants();
        $deletedApplications = [];

        foreach ($users as $user) 
        {
            $application = $user->application();
            if ($application) 
            {
            $application->delete();
            $deletedApplications[] = $user->user_id;
            }
        }
    
        return $deletedApplications;
    }

    /**
     * Retrieves the full application details including user addresses.
     * 
     * This method gathers the user's school, postal, and physical addresses
     * and merges them with other application values.
     *
     * @return array An associative array containing the application's values
     *               and the user's addresses.
     */
    public function full_application(): array
    {

        try{
            $addresses = [
                'school_address' => $this->user()->school_address(),
                'postal_address' => $this->user()->postal_address(),
                'physical_address' => $this->user()->physical_address(),
            ];

        } catch (ModelNotFoundException $e) {
            $addresses = [
                'school_address' => null,
                'postal_address' => null,
                'physical_address' => null,
            ];
        }

        return array_merge($this->values, $addresses);
    }
}

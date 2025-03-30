<?php

require_once 'Model.php';
require_once 'User.php';
require_once 'Application.php';
require_once 'Session.php';
require_once 'Enrollment.php';

class WaitList extends Model
{
    protected static $table = 'waitlists';
    protected static $hidden = ['id_user','made_on'];
    protected static $primary_key = 'id';

    public function _construct(array $attributes, array $sanitized)
    {
        parent::__construct($attributes, $sanitized);
    }

    /**
     * Returns an array of users that are currently in the waitlist queue.
     * Each user is represented by an array with the following keys:
     * - user_id: the id of the user
     * - full_name: the name of the user
     * - preferred_session: the title of the session that the user prefers or null if the user has no preference
     * - application_id: the id of the user's application
     * 
     * @return array
     */
    public static function waitQueue()
    {
        $approvedApplicants = User::approvedApplicants();
        
        $usersInSessions = [];
        foreach ($approvedApplicants as $user) {
            $usersInSessions[] = $user['user_id'];
        }
        
        $waitingUsers = [];
        $allApplicants = User::allApplicants();
        
        foreach ($allApplicants as $user) {
            
            $application = $user->application();
            
            if ($application && 
                Application::getStatusInEnglish($application->status) === 'waitlist' && 
                !in_array($user->user_id, $usersInSessions)) {
                
                $session = null;
                if ($application->id_preferred_session) {
                    try {
                        $session = Session::find($application->id_preferred_session);
                    } catch (ModelNotFoundException $e) {
                    }
                }
                
                $waitingUsers[] = [
                    'user_id' => $user->user_id,
                    'full_name' => $user->full_name(),
                    'preferred_session' => $session ? $session->title : 'No preference', // This is for testing purposes
                    'application_id' => $application->id_application, // This is for testing purposes
                    'made_on' => $application->made_on
                
                ];
            }
        }
        
        return $waitingUsers;
    }

}


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
                Application::getStatusInEnglish($application->status) === 'approved' && 
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

    /**
     * Adds a user to the waitlist queue if their application is approved but they are not enrolled in their preferred session.
     *
     * This function checks if the user's application status is approved and verifies whether they are already
     * enrolled in their preferred session. If they are not, the user is added to the waitlist queue.
     *
     * @param User $user The user to be added to the waitlist.
     */

    public static function Enqueue($user)
    {
        $application = $user->application();
        if ($application && Application::getStatusInEnglish($application->status) === 'approved') {
            $session = Session::find($application->id_preferred_session);
            if (!$session || !$session->students()->where('user_id', $user->user_id)->exists()) {
                // Add user to waitlist queue
                $waitList = new WaitList();
                $waitList->user_id = $user->user_id;
                $waitList->save();
            }
        }

    }
}

<?php
require_once 'Controller.php';

class AcceptedController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        // Get all approved users
        $allApplicants = User::allApplicants();
        $allApproved = [];
        foreach ($allApplicants as $applicant){
            try{
                if ($applicant->application()->getStatusInEnglish($applicant->application()->status) == 'approved'){
                    $allApproved[] = $applicant;
                } 
            } catch (ModelNotFoundException $notFound) {
                continue;
            }
        }

        // Creating a list to hold all accepted users in their respective session
        $sessionsDivided = [];

        // Getting all the active sessions
        try{
           //currentSessions = User::allApplicants($user->application()->id_preffered_session);
        } catch (Exception $e) {
            throw new Exception("An error occurred: " . $e->getMessage());
        }
        
        $currentSessions = []; // define this

        // Separate every accepted user into their respective session
        foreach ($currentSessions as $session){
            foreach ($allApproved as $individual){
                try{
                    if ($individual->userApplication->id_preffered_session == $session){
                        $sessionsDivided[$session] = $individual;
                    }
                } catch (Exception $e) {
                    throw new Exception("An error occurred: " . $e->getMessage());
                }
            }
        }
        dd($sessionsDivided);
        render_view('accepted', ['selected' => 'accepted'], 'Aceptados');
    }

    // define your other methods here
}

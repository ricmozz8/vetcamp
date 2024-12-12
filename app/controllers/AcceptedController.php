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
                if ($applicant->status == 'approved'){
                    $allApproved[] = $applicant;
                } 
            } catch (ModelNotFoundException $notFound) {
                continue;
            }
        }

        // Creating a list to hold all accepted users in their respective session
        $sessionsDivided = [[]];

        // Getting all the active sessions
        $currentSessions;

        // Separate every accepted user into their respective session
        //foreach (){
            
        //}

        render_view('accepted', ['selected' => 'accepted'], 'Aceptados');
    }

    // define your other methods here
}

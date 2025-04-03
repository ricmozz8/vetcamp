<?php
require_once 'Controller.php';
require_once'app/models/WaitList.php';
require_once'app/models/Enrollment.php';

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

        $approvedApplicants = User::approvedApplicants();

        $sessions = [];

        foreach ($approvedApplicants as $user) {
            $sessionId = $user['id_preferred_session'];

            $pictureObj = Application::find($user['id_application'])->getProfilePicture();
            $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

            // Agregar la información formateada
            $sessions[$sessionId][] = [
                'user_id'   => $user['user_id'],
                'full_name' => User::find($user['user_id'])->first_name . ' ' . User::find($user['user_id'])->last_name,
                'profile_picture' => $src,
            ];
        }

        $waitingUsers = WaitList::waitQueue();

        foreach ($approvedApplicants as $user) 
        {
            if (!isset($sessions[$user['id_preferred_session']]) || empty($sessions[$user['id_preferred_session']])) 
            {
                WaitList::Enqueue($user);
            }
        }

        $waitingUsersWithPictures = [];
        foreach ($waitingUsers as $user) {
            $application = $user->application();
    
            $pictureObj = $application->getProfilePicture();
            $src = '';
            if ($pictureObj) {
                $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);
            }
    
            $waitingUsersWithPictures[] = [
                'user_id' => $user->user_id,
                'full_name' => User::find($user['user_id'])->first_name . ' ' . User::find($user['user_id'])->last_name,
                'profile_picture' => $src,
            ];


        }

       $user_id = Auth::user()->user_id;
       $applicants = Enrollment::getCurrentApplicants($user_id);

       $applicantsWithPictures = [];
       foreach ($applicants as $applicant) {
           $application = Application::find($applicant['id_application']);
           
           $pictureObj = $application->getProfilePicture();
           $src = '';
           if ($pictureObj) {
               $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);
           }
           
           $applicantsWithPictures[] = [
               'user_id' => $applicant['user_id'],
               'full_name' => User::find($applicant['user_id'])->first_name . ' ' . User::find($applicant['user_id'])->last_name,
               'profile_picture' => $src,
           ];
       }



       render_view('accepted', [
        'sessions' => $sessions,
        'waitingUsers' => $waitingUsersWithPictures,
        'applicants' => $applicantsWithPictures
    ], 'Accepted');

    }

    // define your other methods here
}
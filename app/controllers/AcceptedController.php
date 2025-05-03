<?php
require_once 'Controller.php';
require_once 'app/models/Waitlist.php';

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

        $sessions = []; //change the logic so enrollments are grouped by session

        $sessionObjects = Session::all();

        $messages = Message::all();



        foreach ($sessionObjects as $session) {
            $sessions[] = [
                'id' => $session->session_id,
                'title' => $session->title,
                'start_date' => $session->start_date,
                'end_date' => $session->end_date,
                'students' => $session->students()
            ];
        }


        $usersInqueue = Waitlist::allWith('users', 'user_id');
        //dd($usersInqueue);
        $waitlists = [];

        foreach ($usersInqueue as $waitlist) {
            //dd($usersInqueue);
            $waitlists[] = [
                'id' => $waitlist->id,
                'user_id' => $waitlist->user_id,
                'name' => $waitlist->first_name . ' ' . $waitlist->last_name,
                'students' => []

            ];
        }



        //dd($waitlists);


        render_view(
            'accepted',
            [
                'selected' => 'accepted',
                'approvedPool' => $approvedApplicants,
                'sessions' => $sessions,
                'waitlist' => $waitlists,
                'messages' =>  $messages
            ],
            'Aceptados'
        );
    }
    // define your other methods here

    public static function enroll($method)
    {

        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        if ($method == 'POST') {

            $session = filter_input(INPUT_POST, 'session');
            $students = filter_input(INPUT_POST, 'students', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            //dd($session, $students); 

            if ($session == 'waitlist') {
                foreach ($students as $student) {
                    $user = User::find($student);
                    if ($user) {
                        // Use exists() to check if the user is already in the waitlist
                        $alreadyInWaitlist = Waitlist::exists([
                            'user_id' => $user->user_id,
                        ]);

                        if ($alreadyInWaitlist) {
                            // Skip adding the user if they are already in the waitlist
                            continue;
                        } else {
                            Waitlist::create([
                                'user_id' => $user->user_id,
                            ]);

                            $application = Application::findBy([
                                'user_id' => $user->user_id,
                            ]);

                            if ($application) {
                                // Change the status from "approved" to "waitlist"
                                $application->update([
                                    'status' => 'waitlist',
                                ]);
                            }
                        }
                    }

                }
                redirect('/admin/accepted');

            } elseif ($session != 'waitlist') {
                if ($session > 0) {
                    foreach ($students as $student) {
                        $user = User::find($student);
                        if ($user) {
                            Enrollment::create([
                                'user_id' => $user->user_id,
                                'session_id' => $session,
                            ]);

                            // Update the status in the applications table
                            $application = Application::findBy([
                                'user_id' => $user->user_id,
                            ]);

                            if ($application) {
                                // Change the status to "enrolled"
                                $application->update([
                                    'status' => 'enrolled',
                                ]);
                            }
                        }
                    }
                }

            }
        }
        redirect('/admin/accepted');
    }
    public static function autoEnroll($method)
    {

        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }
        if ($method == 'POST') {


            dd('AUTOENROLL THE STUDENTS BASED ON THEIR PREFERRED SESSION HERE');

        } else {
            redirect('admin/accepted/enroll');
        }
    }
}

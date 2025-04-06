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

        $approvedApplicants = User::approvedApplicants();


        $sessions = []; //change the logic so enrollments are grouped by session

        $sessionObjects = Session::all();

        $waitlist = []; // retreive the waitlist here

        foreach ($sessionObjects as $session) {
            $sessions[$session->title] = [];
        }

        render_view(
            'accepted',
            [
                'selected' => 'accepted',
                'approvedPool' => $approvedApplicants,
                'sessions' => $sessions,
                'waitlist' => $waitlist
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

            dd($session, $students); 

            // Enroll the students here
        } else {
            redirect('/accepted');
        }
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
            redirect('/accepted');
        }
    }
}

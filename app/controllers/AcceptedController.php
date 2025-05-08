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

        $waitlists = [];
        try {
            $waitlists = Application::findAllBy(['status' => 'waitlist']);
        } catch (ModelNotFoundException $e) {
            $waitlists = [];
        }


        //dd($waitlists);
        $messages = Message::all();



        render_view(
            'accepted',
            [
                'selected' => 'accepted',
                'approvedPool' => $approvedApplicants,
                'sessions' => $sessions,
                'waitlist' => $waitlists,
                'messages' => $messages
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

            if ($session == 'waitlist') {
                foreach ($students as $student) {
                    try {
                        User::find($student)->application()->update([
                            'status' => 'waitlist',
                        ]);
                    } catch (Exception $e) {
                        ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                        $_SESSION['error'] = 'Ocurrió un error al inscribir al estudiante.';
                        redirect('/admin/accepted');
                    }
                }
                redirect('/admin/accepted');
            } else {
                foreach ($students as $student) {

                    try {
                        $user = User::find($student);

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
                    } catch (Exception $e) {
                        ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                        $_SESSION['error'] = 'Ocurrió un error al inscribir al estudiante.';
                        redirect('/admin/accepted');
                    }
                }
            }
        }
        redirect('/admin/accepted');
    }

    public static function unenroll($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        if ($method == 'POST') {

            $students = filter_input(INPUT_POST, 'students', FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);

            $is_waitlist = filter_input(INPUT_POST, 'is_waitlist');

            if (empty($students)) {
                $_SESSION['error'] = 'Por favor seleccione al menos un estudiante.';
                redirect('/admin/accepted');
            }
            foreach ($students as $student) {

                try {
                    User::find($student)->application()->update([
                        'status' => 'approved',
                    ]);
                    if (!$is_waitlist) {
                        Enrollment::findBy([
                            'user_id' => $student
                        ])->delete();
                    }
                } catch (Exception $e) {
                    ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                    $_SESSION['error'] = 'Ocurrió un error al inscribir al estudiante.';
                    redirect('/admin/accepted');
                }
            }
            $_SESSION['message'] = 'Estudiantes desmatriculados exitosamente.';
        }


        redirect('/admin/accepted');
    }
}

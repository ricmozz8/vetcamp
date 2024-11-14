<?php
require_once 'Controller.php';
require_once 'app/models/User.php';

class BackDashboardController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        // Get registered and applicant stats
        $all_users = count(User::allOf('user'));
        $all_applicants = count(User::allApplicants());

        // your index view here
        render_view('backDashboard', [    'all_users' => $all_users,
                                          'all_applicants' => $all_applicants ],
                    'BackDashboard');
    }

}

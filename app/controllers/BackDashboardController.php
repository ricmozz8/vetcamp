<?php
require_once 'Controller.php';
require_once 'app/models/User.php';
require_once 'app/models/Application.php';

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

        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type !== 'admin') {
            redirect('/apply');
        }



        // Get registered and applicant stats

        $recent_registered = User::allOf('user');

        $all_users = count($recent_registered);
        $recent_applications = User::allApplicants();
        $all_applicants = count($recent_applications);


        usort($recent_registered, function ($a, $b) {
            $timeA = $a->created_at ? strtotime($a->created_at) : 0;
            $timeB = $b->created_at ? strtotime($b->created_at) : 0;
            return $timeB - $timeA;
        });

        $recent_registered = array_slice($recent_registered, 0, 5);


        usort($recent_applications, function ($a, $b) {
            $timeA = $a->application()->created_at ? strtotime($a->application()->created_at) : 0;
            $timeB = $b->application()->created_at ? strtotime($b->application()->created_at) : 0;
            return $timeB - $timeA;
        });

        $recent_applications = array_slice($recent_applications, 0, 5);

        // excluding unsubmitted applications
        $recent_applications = array_filter($recent_applications, function ($user) {
            return $user->application()->isComplete();
        });



        render_view('backDashboard', [
            'all_users' => $all_users,
            'all_applicants' => $all_applicants,
            'recent_registered' => $recent_registered,
            'recent_applications' => $recent_applications,
            'selected' => 'start',
        ], 'Administración');
    }

    /**
     * Formats a timestamp to a human-readable format.
     *
     * @param string $timestamp
     * @return string
     */
    private static function formatTimestamp($timestamp)
    {
        $created_at = new DateTime($timestamp);
        $now = new DateTime();
        $interval = $now->diff($created_at);

        if ($interval->days === 0) {
            return 'hoy a las ' . $created_at->format('g:i a');
        } elseif ($interval->days === 1) {
            return 'ayer a las ' . $created_at->format('g:i a');
        } else {
            return $created_at->format('d/m/Y g:i a');
        }
    }
}

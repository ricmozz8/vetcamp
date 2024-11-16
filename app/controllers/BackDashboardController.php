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
        // Get registered and applicant stats
        $all_users = count(User::allOf('user'));
        $all_applicants = count(User::allApplicants());

        // Get recent registered users
        $recent_registered = User::allOf('user');
        usort($recent_registered, function($a, $b) {
            $timeA = $a->created_at ? strtotime($a->created_at) : 0;
            $timeB = $b->created_at ? strtotime($b->created_at) : 0;
            return $timeB - $timeA;
        });
        $recent_registered = array_slice($recent_registered, 0, 5);

        // Format timestamps for recent registered users
        foreach ($recent_registered as $user) {
            $user->formatted_created_at = self::formatTimestamp($user->created_at);
        }

        // Get recent applications
        $recent_applications = User::allApplicants();
        usort($recent_applications, function($a, $b) {
            $timeA = $a->application()->created_at ? strtotime($a->application()->created_at) : 0;
            $timeB = $b->application()->created_at ? strtotime($b->application()->created_at) : 0;
            return $timeB - $timeA;
        });
        $recent_applications = array_slice($recent_applications, 0, 5);

        foreach ($recent_applications as $application) {
            if ($application->user) {
                $application->url_picture = $application->$user->User::getPictureUrl(); // getPictureUrl() to be added
            } else {
                $application->url_picture = 'https://img.icons8.com/?size=100&id=7819&format=png&color=737373';
            }
        }

        // Now call render_view with the defined variables
        render_view('backDashboard', [
            'all_users' => $all_users,
            'all_applicants' => $all_applicants,
            'recent_registered' => $recent_registered,
            'recent_applications' => $recent_applications
        ], 'BackDashboard');
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

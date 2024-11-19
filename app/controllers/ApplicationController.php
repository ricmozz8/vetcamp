<?php
require_once 'Controller.php';

class ApplicationController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function editApplication($user_id)
    {
        if ($user_id == null) {
            redirect('/admin/requests');
        }
        // your index view here
        $user = User::find($user_id);
        $application = $user->application();
        
        render_view('profile', 
            ['user' => $user, 
            'application' => $application,
            'postal_address' => $user->postal_address(),
            'physical_address' => $user->physical_address(),
            'school_address' => $user->school_address(),
            'preferred_session' => $application->preferred_session(true),
        ], 'Aplicación');

    }
    public static function updateStatus($request_method)
    {
        if ($request_method === 'POST') {
            // Extract POST data
            $applicationId = $_POST['application_id'] ?? null;
            $newStatus = $_POST['status'] ?? null;

            if ($applicationId && $newStatus) {
                // Attempt to find the application
                $application = Application::find($applicationId);

                if ($application) {
                    // Update the application's status
                    $application->update(['status' => $newStatus]);

                    // Set success feedback
                    $_SESSION['success_message'] = "Application status updated successfully.";
                } else {
                    // Application not found
                    $_SESSION['error_message'] = "Application not found.";
                }
            } else {
                // Missing or invalid input
                $_SESSION['error_message'] = "Invalid input. Please provide both application ID and status.";
            }
        } else {
            // Invalid request method
            http_response_code(405);
            $_SESSION['error_message'] = "Invalid request method.";
        }

        // Redirect back to the settings page
        header('Location: /admin/settings');
        exit;
    }
    // define your other methods here
}

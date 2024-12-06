<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{
    public static function TrackingEvaluation($request_method)
    {
        // Ensure the request method is POST
        if ($request_method === 'POST') {
            if (!Auth::check()) {
                $_SESSION['error_message'] = "User not authenticated.";
                redirect('/admin/login');
                return;
            }
            // Retrieve the application ID from the POST data
            $applicationId = $_POST['application_id'] ?? null;
            $user = Auth::user();

            $userId = $user ? $user->__get('user_id') : null;
            // Validate application ID and user authentication
            if ($applicationId === null || $userId === null) {
                $_SESSION['error_message'] = "Invalid request or user not authenticated.";
                redirect('/admin/requests');
                return;
            }

            // Check if the application exists
            try {
                $application = Application::find($applicationId);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error_message'] = "Application not found.";
                redirect('/admin/requests');
                return;
            }

            // Check if a tracking record already exists for this user and application
            $trackingExists = Tracking::exists([
                'application_id' => $applicationId,
                'user_id' => $userId,
            ]);

            if ($trackingExists) {
                $_SESSION['error_message'] = "This application has already been evaluated by this user.";
                redirect('/admin/requests');
                return;
            }

            try {
                // Create a new tracking record in the evaluated_by table
                Tracking::create([
                    'application_id' => $applicationId,
                    'user_id' => $userId,
                ]);

                $_SESSION['success_message'] = "Evaluation tracking recorded successfully.";
                redirect('/admin/requests?id=' . $applicationId . '&tracking=success');
            } catch (Exception $e) {
                $_SESSION['error_message'] = "An error occurred: " . $e->getMessage();
                redirect('/admin/requests');
            }
        } else {
            http_response_code(405);
            $_SESSION['error_message'] = "Invalid request method.";
            redirect('/admin/requests');
        }
    }
}



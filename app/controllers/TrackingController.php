<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{
    public static function TrackingEvaluation($request_method)
    {
        // Ensure the request method is POST
        if ($request_method === 'POST') {
            // Retrieve the application ID from the POST data
            $applicationId = $_POST['application_id'] ?? null;

            // Check if the application ID exists
            if ($applicationId !== null) {
                // Create a record in the evaluated_by table
                Tracking::create([
                    'application_id' => $applicationId,       // Application ID from POST data
                    'user_id' => Auth::$user->__get('id'),   // Admin's user ID (evaluator)
                ]);
                redirect('/admin/application?id=' . $applicationId . '&tracking=success');
            }
        }
    }
}




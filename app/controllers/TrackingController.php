<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{

    public static function TrackingEvaluation($request_method)
    {
        // Check if the request method is POST
        if ($request_method === 'POST') {
            // Get the application ID from the POST data
            $applicationId = $_POST['application_id'] ?? null;

            if ($applicationId !== null) {
                // Create a tracking entry with user_id (the evaluator) and application_id
                Tracking::create([
                    'user_id' => Auth::$user->__get('id'),  // The evaluator's user ID
                    'application_id' => $applicationId,     // The ID of the application being evaluated
                ]);
            
            // redirect(url: '/admin');         // COMMENTED TO PREVENT CRASH
            }
        }
    } 
}




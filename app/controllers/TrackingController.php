<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{
    public static function TrackingEvaluation($request_method)
    {
        // Ensure the request method is POST
        if ($request_method === 'POST') {
            $applicationId = $_POST['application_id'] ?? null;
            $decision = $_POST['status'] ?? null; // The status selected in the form
            $madeOn = date('Y-m-d H:i:s'); // Current timestamp

            // Log the user object for debugging
            $user = Auth::user();
            $userId = null;
            if ($user) {
                // Safely retrieve user_id via the __get method if it exists
                if (isset($user->attributes['user_id'])) {
                    $userId = $user->attributes['user_id'];
                } elseif (method_exists($user, '__get')) {
                    $userId = $user->__get('user_id');
                }
            }


            // Map of Spanish to English status values
            $status_map = [
                'Sometida' => 'submitted',
                'Necesita Cambios' => 'need_changes',
                'Denegada' => 'denied',
                'Aprobada' => 'approved',
                'Incompleta' => 'incomplete',
                'No Sometida' => 'unsubmitted',
            ];

            // Convert status to English using the map
            $decision = $status_map[$decision] ?? null;

            // Validate data
            if ($applicationId === null || $userId === null || $decision === null) {
                redirect('/admin/requests');
                return;
            }

            try {
                // Create a new tracking record with the updated decision (status)
                Tracking::create([
                    'application_id' => $applicationId,
                    'user_id' => $userId,
                    'decision' => $decision, // Use the mapped decision
                    'made_on' => $madeOn,
                ]);
            } catch (Exception $e) {
                redirect('/admin/requests');
            }
        } else {
            http_response_code(405);
            redirect('/admin/requests');
        }
    }
}




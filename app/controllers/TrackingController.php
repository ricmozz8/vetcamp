<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{
  public static function TrackingEvaluation($request_method)
    {
        if ($request_method === 'POST') {
            // Initialize variables
            $applicationId = null;
            $decision = null;
    
            // Sanitize and validate input
            if (isset($_POST['application_id']) && is_numeric($_POST['application_id'])) {
                $applicationId = (int) $_POST['application_id'];
            }
    
            if (isset($_POST['status']) && is_string($_POST['status'])) {
                // Reverse mapping: Spanish status to English key
                $statusMap = array_flip(Application::$statusParsings);
                if (isset($statusMap[$_POST['status']])) {
                    $decision = $statusMap[$_POST['status']];
                }
            }
    
            // Get the authenticated user
            $user = Auth::user();
            $userId = $user?->__get('user_id') ?? null;
    
            // Validate required data
            if ($applicationId === null || $userId === null || $decision === null) {
                $_SESSION['error_message'] = "Datos inválidos o incompletos.";
                redirect('/admin/requests');
                return;
            }
    
            try {
                // Create a new tracking record
                Tracking::create([
                    'application_id' => $applicationId,
                    'user_id' => $userId,
                    'decision' => $decision,
                ]);
    
                $_SESSION['success_message'] = "Seguimiento registrado correctamente.";
                redirect('/admin/requests');
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error al registrar el seguimiento.";
                redirect('/admin/requests');
            }
        } else {
            http_response_code(405);
            $_SESSION['error_message'] = "Método de solicitud no permitido.";
            redirect('/admin/requests');
        }
    }    
}




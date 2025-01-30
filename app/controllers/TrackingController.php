<?php
require_once 'Controller.php';

require_once 'app/models/Tracking.php';

class TrackingController extends Controller
{
  public static function TrackingEvaluation($request_method)
      {
          if ($request_method === 'POST') {
              // Sanitize and validate input
              $applicationId = filter_input(INPUT_POST, 'application_id', FILTER_VALIDATE_INT);
              $decision = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);
              
              // Validate required data
              if (!$applicationId || !$decision || !array_key_exists($decision, Application::$statusParsings)) {
                  $_SESSION['error'] = "Datos inválidos o incompletos.";
                  redirect('/admin/requests');
                  return;
              }
              
              try {
                  // Get the authenticated user
                  $user = Auth::user();
                  $userId = $user->__get('user_id') ?? null;
      
                  if (!$userId) {
                      $_SESSION['error'] = "Usuario no autenticado.";
                      redirect('/admin/requests');
                      return;
                  }
      
                  // Create a new tracking record
                  Tracking::create([
                      'application_id' => $applicationId,
                      'user_id' => $userId,
                      'decision' => $decision, // Use the raw status key directly
                  ]);
      
                  // Redirect to the specific application page
                  $application = Application::find($applicationId);
                  $userId = $application->user_id;
                  $_SESSION['message'] = 'Se ha cambiado el estado de la solicitud exitosamente';
                  redirect("/admin/requests/r?id=$userId");
              } catch (ModelNotFoundException $e) {
                  $_SESSION['error'] = "No se encontró la solicitud con el ID proporcionado.";
                  redirect('/admin/requests');
              } catch (Exception $e) {
                  $_SESSION['error'] = "Error al registrar el seguimiento: " . $e->getMessage();
                  redirect('/admin/requests');
              }
          } else {
              http_response_code(405);
              $_SESSION['error'] = "Método de solicitud no permitido.";
              redirect('/admin/requests');
          }
      }
}




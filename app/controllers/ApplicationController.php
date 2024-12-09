<?php
require_once 'Controller.php';
require_once 'app/models/Tracking.php';
require_once 'app/models/Application.php';
require_once 'app/models/User.php';

class ApplicationController extends Controller
{

    public static function index()
    {
        // dd(Auth::user()); use this for showing the user
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type == 'admin') {
            redirect('/admin');
        }
        render_view('application/application_dashboard', [], 'Aplica');
    }

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
            'profile_pic'=> $application->url_picture,
            'document_count' => $application->documentCount(),
        ], 'Aplicación');

    }
    public static function updateStatus($request_method)
    {
        if ($request_method === 'POST') {
            $applicationId = $_POST['application_id'] ?? null;
            $newStatus = $_POST['status'] ?? null;
            $notify = isset($_POST['notify']) && $_POST['notify'] === 'on';
    
            // Map of Spanish to English status values
            $status_map = [
                'Sometida' => 'submitted',
                'Necesita Cambios' => 'need_changes',
                'Denegada' => 'denied',
                'Aprobada' => 'approved',
                'Incompleta' => 'incomplete',
                'No Sometida' => 'unsubmitted',
            ];
    
            // Convert status to English
            $newStatus = $status_map[$newStatus] ?? null;
    
            // Validate data
            if ($applicationId === null || $newStatus === null) {
                $_SESSION['error_message'] = "Datos inválidos.";
                redirect('/admin/requests');
                return;
            }
    
            try {
                // Update application status
                $application = Application::find($applicationId);
                $application->update(['status' => $newStatus]);
                
                // Call TrackingEvaluation for tracking
                TrackingController::TrackingEvaluation('POST');

                if ($notify) {
                    $_SESSION['success_message'] = "Estado actualizado y notificación enviada.";
                } else {
                    $_SESSION['success_message'] = "Estado actualizado correctamente.";
                }
                redirect('/admin/requests');
            } catch (ModelNotFoundException $e) {
                $_SESSION['error_message'] = "No se encontró la solicitud con el ID proporcionado.";
                redirect('/admin/requests');
            } catch (Exception $e) {
                $_SESSION['error_message'] = "Error al actualizar el estado.";
                redirect('/admin/requests');
            }
        } else {
            http_response_code(405);
            $_SESSION['error_message'] = "Método de solicitud no permitido.";
            redirect('/admin/requests');
        }
    }
        public function archive()
    {
        try {
            // Set the default file name if not provided
            $filePath = 'solicitudes_archivadas_' . date('Y-m-d_H-i-s') . '.csv';
    
            // Open the CSV file for writing
            $file = fopen($filePath, 'w');
            if (!$file) {
                throw new Exception('No se pudo abrir el archivo para escribir.');
            }
    
            // Add UTF-8 BOM for correct encoding
            fwrite($file, "\xEF\xBB\xBF");
    
            // Write the CSV header
            fputcsv($file, ['Nombre', 'Correo', 'Creado En', 'Evaluado En', 'Nombre del Evaluador', 'Decisión Final']);
    
            // Mapa para traducir decisiones al español
            $decisionMap = [
                'approved' => 'Aprobada',
                'denied' => 'Denegada',
                'need_changes' => 'Necesita Cambios',
                'submitted' => 'Sometida',
                'unsubmitted' => 'No Sometida',
                'incomplete' => 'Incompleta',
            ];
    
            // Obtener todas las aplicaciones
            $applications = Application::all();
    
            foreach ($applications as $application) {
                try {
                    // Obtener datos del usuario
                    $user = User::find($application->user_id);
                    $userFirstName = $user->__get('first_name') ?? 'N/A';
                    $userLastName = $user->__get('last_name') ?? 'N/A';
                    $applicantEmail = $user->__get('email') ?? 'N/A';
    
                    // Formatear la fecha de creación
                    $createdOn = (new DateTime($application->date_created))->format('d') . ' de ' .
                        $this->getMonthInSpanish((new DateTime($application->date_created))->format('m')) . ' de ' .
                        (new DateTime($application->date_created))->format('Y');
    
                    // Obtener datos del evaluador
                    $evaluatedOn = 'N/A';
                    $evaluatorName = 'N/A';
                    try {
                        $evaluator = Tracking::findBy(['application_id' => $application->id_application]);
                        if ($evaluator) {
                            $evaluatorUser = User::find($evaluator->__get('user_id'));
                            $evaluatorFirstName = $evaluatorUser->__get('first_name') ?? 'N/A';
                            $evaluatorLastName = $evaluatorUser->__get('last_name') ?? 'N/A';
                            $evaluatorName = $evaluatorFirstName . ' ' . $evaluatorLastName;
                            $evaluatedOn = (new DateTime($evaluator->__get('made_on')))->format('d') . ' de ' .
                                $this->getMonthInSpanish((new DateTime($evaluator->__get('made_on')))->format('m')) . ' de ' .
                                (new DateTime($evaluator->__get('made_on')))->format('Y');
                        }
                    } catch (ModelNotFoundException $e) {
                        $evaluatedOn = 'N/A';
                    }
    
                    // Traducir la decisión final
                    $finalDecision = $decisionMap[$application->status] ?? 'Desconocido';
    
                    // Escribir en el archivo CSV
                    fputcsv($file, [
                        $userFirstName . ' ' . $userLastName, // Nombre
                        $applicantEmail,                     // Correo
                        $createdOn,                          // Creado En
                        $evaluatedOn,                        // Evaluado En
                        $evaluatorName,                      // Nombre del Evaluador
                        $finalDecision                       // Decisión Final
                    ]);
                } catch (Exception $e) {
                    // No logging is done here as per request
                }
            }
    
            // Cerrar el archivo
            fclose($file);
    
            // Set headers for file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($filePath);
    
            // Optionally delete the file after sending it to the user
            unlink($filePath);
    
        } catch (Exception $e) {
            // No logging is done here as per request
            redirect('/admin/settings');
        }
    }
    /**
     * Devuelve el nombre del mes en español.
     */
    private function getMonthInSpanish($month)
    {
        $months = [
            '01' => 'enero',
            '02' => 'febrero',
            '03' => 'marzo',
            '04' => 'abril',
            '05' => 'mayo',
            '06' => 'junio',
            '07' => 'julio',
            '08' => 'agosto',
            '09' => 'septiembre',
            '10' => 'octubre',
            '11' => 'noviembre',
            '12' => 'diciembre',
        ];
        return $months[$month] ?? 'desconocido';
    }
    
    
}

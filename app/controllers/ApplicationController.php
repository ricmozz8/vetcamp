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
        try{
            $user = User::find($user_id);
        } catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $user = null;
        }
        

        if ($user == null) {
        $_SESSION['error'] = "No se encontró el usuario con el ID proporcionado.";
            redirect('/admin/requests');
        }



        $application = $user->application();

        if ($application == null) {
            $_SESSION['error'] = "No se encontró la solicitud del usuario con el ID proporcionado.";
            redirect('/admin/requests');
        }

        if($application->status === 'Sin subir') {
            $_SESSION['error'] = "El usuario no ha sometido su solicitud todavia.";
            redirect('/admin/requests');
        }

        render_view(
            'profile',
            [
                'user' => $user,
                'application' => $application,
                'postal_address' => $user->postal_address(),
                'physical_address' => $user->physical_address(),
                'school_address' => $user->school_address(),
                'preferred_session' => $application->preferred_session(true),
                'profile_pic' => $application->url_picture,
                'document_count' => $application->documentCount(),
            ],
            'Aplicación'
        );
    }
    public static function updateStatus($request_method)
    {
        if ($request_method === 'POST') {
            $applicationId = $_POST['application_id'] ?? null;
            $newStatus = $_POST['status'] ?? null;
            $notify = isset($_POST['notify']) && $_POST['notify'] === 'on';

            // Reverse mapping: Spanish status to English key
            $statusMap = array_flip(Application::$statusParsings);
            $newStatus = $statusMap[$newStatus] ?? null;

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

    public static function archive()
    {
        try {
            // Set the default file name
            $filePath = 'solicitudes_archivadas_' . date('Y-m-d_H-i-s') . '.csv';

            // Open the CSV file for writing
            $file = fopen($filePath, 'w');
            if (!$file) {
                redirect('/admin/settings');
                return;
            }

            // Add UTF-8 BOM for correct encoding
            fwrite($file, "\xEF\xBB\xBF");

            // Write the CSV header
            fputcsv($file, ['Nombre', 'Correo', 'Creado En', 'Evaluado En', 'Nombre del Evaluador', 'DecisiÃ³n Final']);

            // Fetch all applications
            $applications = Application::all();
            if (empty($applications)) {
                $_SESSION['error_message'] = "No hay datos disponibles para archivar.";
                redirect('/admin/settings');
                return;
            }

            foreach ($applications as $application) {
                try {
                    // Fetch user data
                    $user = User::find($application->user_id);
                    if (!$user) {
                        continue; // Skip if user data is missing
                    }

                    $userFirstName = $user->first_name ?? 'N/A';
                    $userLastName = $user->last_name ?? 'N/A';
                    $applicantEmail = $user->__get('email') ?? 'N/A';

                    // Format creation date
                    $createdOn = get_date_spanish($application->date_created);

                    // Fetch evaluator data
                    $evaluatedOn = 'N/A';
                    $evaluatorName = 'N/A';
                    try {
                        $evaluator = Tracking::findBy(['application_id' => $application->id_application]);
                        if ($evaluator) {
                            $evaluatorUser = User::find($evaluator->__get('user_id'));
                            if ($evaluatorUser) {
                                $evaluatorFirstName = $evaluatorUser->first_name ?? 'N/A';
                                $evaluatorLastName = $evaluatorUser->last_name ?? 'N/A';
                                $evaluatorName = $evaluatorFirstName . ' ' . $evaluatorLastName;
                                $evaluatedOn = get_date_spanish($evaluator->__get('made_on'));
                            }
                        }
                    } catch (ModelNotFoundException $e) {
                        $evaluatedOn = 'N/A';
                    }

                    // Translate the final decision
                    $finalDecision = Application::$statusParsings[$application->status] ?? 'Desconocido';

                    // Write to the CSV file
                    fputcsv($file, [
                        $userFirstName . ' ' . $userLastName,
                        $applicantEmail,
                        $createdOn,
                        $evaluatedOn,
                        $evaluatorName,
                        $finalDecision
                    ]);
                } catch (Exception $e) {
                    continue;
                }
            }

            // Close the file
            fclose($file);

            // Set headers for file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Pragma: no-cache');
            header('Expires: 0');
            readfile($filePath);

            unlink($filePath);
        } catch (Exception $e) {
            $_SESSION['error_message'] = "Error al generar el archivo de solicitudes.";
            redirect('/admin/settings');
        }
    }
}

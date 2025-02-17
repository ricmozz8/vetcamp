<?php
require_once 'Controller.php';
require_once 'app/models/Tracking.php';
require_once 'app/models/Application.php';
require_once 'app/models/User.php';
require_once 'app/models/LimitDate.php';

class ApplicationController extends Controller
{

    /**
     * Validates if the current time is within the limit dates.
     *
     * @return boolean True if the current time is within the limit dates, false otherwise.
     */
    private static function validate_time_limit(): bool
    {
        $limit_date = LimitDate::find(1);
        if (time() > $limit_date->end_date) {
            return false;
        }
        return true;
    }

    /**
     * @throws ViewNotFoundException
     */
    public static function index()
    {

        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type == 'admin') {
            redirect('/admin');
        }
        render_view('application/application_dashboard', ['can_apply' => self::validate_time_limit()], 'Aplica');
    }

    /**
     * This renders the index view.
     *
     *
     * @return void
     * @throws ViewNotFoundException
     */
    public static function editApplication($user_id)
    {

        if ($user_id == null) {
            redirect('/admin/requests');
        }
        // your index view here
        try {
            $user = User::find($user_id);
            $application = $user->application();
        } catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $_SESSION['error'] = "No se encontró el usuario con el ID proporcionado.";
            redirect('/admin/requests');
        }


        if ($application == null) {
            $_SESSION['error'] = "No se encontró la solicitud del usuario con el ID proporcionado.";
            redirect('/admin/requests');
        }

        if ($application->status === 'Sin subir') {
            $_SESSION['error'] = "El usuario no ha sometido su solicitud todavia.";
            redirect('/admin/requests');
        }

        $valid_statuses = Application::$statusParsings;


        $valid_statuses = array_diff_key(Application::$statusParsings, ['unsubmitted' => 'Sin subir']);

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
                'documents' => $application->getDocuments(),
                'statuses' => $valid_statuses,
            ],
            'Solicitud'
        );
    }

    public static function updateStatus($request_method)
    {
        if ($request_method === 'POST') {
            $applicationId = filter_input(INPUT_POST, 'application_id', FILTER_VALIDATE_INT);
            $newStatus = filter_input(INPUT_POST, 'status', FILTER_DEFAULT);

            // Validate application ID and new status
            if (!$applicationId || !$newStatus || !array_key_exists($newStatus, Application::$statusParsings)) {
                $_SESSION['error'] = "Los datos proporcionados no son válidos.";
                redirect('/admin/requests');
                return;
            }

            try {
                // Update application status
                $application = Application::find($applicationId);
                $application->update(['status' => $newStatus]);
                $user_id = $application->user()->user_id;

                Tracking::create(['application_id' => $applicationId, 'user_id' => Auth::user()->__get('user_id'), 'decision' => $newStatus]);

            } catch (ModelNotFoundException $e) {
                ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                $_SESSION['error'] = "No se encontró la solicitud con el ID proporcionado.";
                redirect('/admin/requests');
            } catch (Exception $e) {
                ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                $_SESSION['error'] = "Error al actualizar el estado.";
                redirect('/admin/requests');
            }


            // Redirect to admin requests page
            $_SESSION['message'] = "Estado de la solicitud actualizado correctamente.";

            redirect('/admin/requests/r?id=' . $user_id);

        } else {
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
                $_SESSION['error'] = "Error opening file for writing.";
                redirect('/admin/settings');
                return;
            }

            // Add UTF-8 BOM for correct encoding
            fwrite($file, "\xEF\xBB\xBF");

            // Write the CSV header
            fputcsv($file, ['Nombre', 'Correo', 'Creado En', 'Evaluado En', 'Nombre del Evaluador', 'Decisión Final']);

            // Fetch all applications
            $applications = Application::all();
            if (empty($applications)) {
                $_SESSION['error'] = "No hay datos disponibles para archivar.";
                redirect('/admin/settings');
                return;
            }
            foreach ($applications as $application) {
                try {
                    // Get the internal status key (e.g., 'unsubmitted', 'approved', etc.)
                    $internalStatusKey = array_search($application->status, Application::$statusParsings);

                    // Skip if the status is 'unsubmitted' (i.e., 'Sin subir')
                    if ($internalStatusKey === 'unsubmitted') {
                        //   file_put_contents('debug_log.txt', "Skipping application ID: {$application->id_application} because the status is 'unsubmitted' ('Sin subir')\n", FILE_APPEND);
                        continue; // Skip this iteration if the status is 'unsubmitted'
                    }

                    // Get the user data
                    $user = User::find($application->user_id);
                    if (!$user) {
                        continue; // Skip if user data is missing
                    }

                    // Prepare user and application data
                    $userFirstName = $user->first_name ?? 'N/A';
                    $userLastName = $user->last_name ?? 'N/A';
                    $applicantEmail = $user->__get('email') ?? 'N/A';
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

                    $statusMap = array_flip(Application::$statusParsings);
                    // Translate the final decision
                    $finalDecision = $statusMap[$application->status] ?? 'Desconocido';


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

            // Close the file after all data has been written
            fclose($file);

            // Set headers for file download
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Output the file to the browser
            readfile($filePath);
            // Delete the file after sending it to the browser
            unlink($filePath);
            exit();
        } catch (Exception $e) {
            // Catch any other exceptions and show an error message
            $_SESSION['error'] = "Error al generar el archivo de solicitudes: " . $e->getMessage();
            redirect('/admin/settings');
        }
    }


    /**
     * Makes a comment to the application
     * @param string $method Either GET or POST depending on the server's request method
     * @return void redirects the user to the profile
     */
    public static function comment(string $method)
    {

        if ($method === 'POST') {

            // getting the data from the form
            $comment = filter_input(INPUT_POST, 'comment');
            $application_id = filter_input(INPUT_POST, 'application_id');
            $user_id = filter_input(INPUT_POST, 'user_id');

            if (!$comment) {
                $_SESSION['error'] = 'El comentario no puede ser vacío';
                redirect('/admin');
            }

            if (!$application_id) {
                ErrorLog::log('Tried to pass a null key for application_id to comment function', __FILE__, '');

                // Programming error or the user removed the id from the hidden input, log the error as debug.
                $_SESSION['error'] = 'Ha ocurrido un error al actualizar el comentario';
                redirect('/admin');
            }

            Comment::create([
                'comment' => $comment,
                'application_id' => $application_id,
                'user_id' => Auth::user()->__get('user_id')
            ]);

            $_SESSION['message'] = 'Comentario agregado correctamente';
            // send the user back to the application view
            redirect('/admin/requests/r?id=' . $user_id);

        } else {
            // GET method not allowed
            redirect('/admin');
        }

    }
}

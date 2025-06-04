<?php
require_once 'Controller.php';
require_once 'app/models/Tracking.php';
require_once 'app/models/Application.php';
require_once 'app/models/User.php';
require_once 'app/models/LimitDate.php';
require_once 'app/models/Audit.php';

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
        // dd(Auth::user()); use this for showing the user
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

      

        $valid_statuses = Application::$statusParsings;


        
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

    /**
     * Deletes an application given its ID
     *
     * This function is called through an AJAX POST request from the admin dashboard.
     * It deletes the application with the given ID and all its associated documents.
     * Redirects to the request list page after deletion.
     *
     * @param string $request_method The HTTP request method used to call this function.
     *
     * @return void
     */
    public static function deleteApplication(string $request_method)
    {
        if ($request_method === "POST") {

            $application_id = filter_input(INPUT_POST, 'application_id', FILTER_VALIDATE_INT);
            try {

                $application = Application::find($application_id);
                $application->hard_delete();

                // Log the deletion
                Audit::register('Se borró la solicitud del usuario ' . $application->user()->email, 'delete');
            } catch (ModelNotFoundException $e) {

                $_SESSION['error'] = 'Solicitud no encontrada.';
            }
        }

        $_SESSION['message'] = 'Solicitud eliminada correctamente.';
        redirect('/admin/requests');
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

                $previous_status = $application->status;
                $user_id = $application->user()->user_id;

                if ($application->documentCount() < Application::REQUIRED_DOCUMENTS_AMOUNT && $newStatus == 'submitted') {
                    $_SESSION['error'] = "No se puede publicar una solicitud con documentos faltantes";
                    redirect('/admin/requests/r?id=' . $user_id);
                    return;
                }

                $application->update(['status' => $newStatus]);

                


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

            // Log the update
            Audit::register('Se actualizó el estado de la solicitud del usuario ' .
                $application->user()->email . ' de ' .
                $previous_status . ' a ' .
                Application::$statusParsings[$newStatus] . '.', 'update');


            redirect('/admin/requests/r?id=' . $user_id);
        } else {
            redirect('/admin/requests');
        }
    }

    public static function archive()
    {
        try {
            // Set the default file name
            $filePath = 'solicitudes_archivadas_' . date('Y-m-d_H-i-s') . '.zip';

            // Create the ZIP archive
            $zip = new ZipArchive();
            if ($zip->open($filePath, ZipArchive::CREATE) !== true) {
                $_SESSION['error'] = "Error al crear el archivo ZIP.";
                redirect('/admin/settings');
                return;
            }

            // Fetch all applications
            $applications = Application::all();
            if (empty($applications)) {
                $_SESSION['error'] = "No hay datos disponibles para archivar.";
                redirect('/admin/settings');
                return;
            }
            foreach ($applications as $application) {
                try {
                    $internalStatusKey = array_search($application->status, Application::$statusParsings);
                    if ($internalStatusKey === 'unsubmitted') {
                        continue;
                    }

                    $user = User::find($application->user_id);
                    if (!$user) {
                        continue;
                    }

                    $folder = str_replace(' ', '_', $user->first_name . '_' . $user->last_name) . '_' . str_replace('@', '_', $user->email);
                    $documents = $application->getDocuments();

                    foreach ($documents as $document) {
                        $zip->addFromString($folder . '/' . $document['name'], $document['contents']);
                    }
                } catch (Exception $e) {
                    continue;
                }
            }

            // Close the file after all data has been written
            $zip->close();

            // Set headers for file download
            header('Content-Type: application/zip');
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

            Audit::register('Comentario agregado en la solicitud con ID ' . $application_id, 'create');

            $_SESSION['message'] = 'Comentario agregado correctamente';
            // send the user back to the application view
            redirect('/admin/requests/r?id=' . $user_id);
        } else {
            // GET method not allowed
            redirect('/admin');
        }
    }

    public static function download($method)
    {
        if ($method === 'POST') {
            $user_id = filter_input(INPUT_POST, 'id');
            try {
                $user = User::find($user_id);
                $application = $user->application();
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'La solicitud no existe.';
                redirect('/admin/requests');
            }

            $documents = $application->getDocuments();


            // compress all files to a zip called 'request_export_DATE_user_email_.zip'
            $zip = new ZipArchive();
            $filename = 'export_' . date('Y_m_d') . '_' . $user->__get('first_name') . '_' . str_replace(' ', '_', $user->__get('last_name')) . '.zip';

            if ($zip->open($filename, ZipArchive::CREATE) !== TRUE) {
                $_SESSION['error'] = 'Error al exportar el archivo';
                ErrorLog::log('There was an error trying to export an application', __FILE__, '');
            }

            foreach ($documents as $document) {
                $zip->addFromString($document['name'], $document['contents']);
            }

            $zip->close();

            // serve the zip file to download
            header('Content-Type: application/zip');
            header("Content-Disposition: attachment; filename=" . basename($filename));
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($filename));
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Expires: 0');
            readfile($filename);
            unlink($filename);
        }

        redirect_back();
    }
}

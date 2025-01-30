<?php
require_once 'Controller.php';
require_once 'app/models/Message.php';
require_once 'app/models/LimitDate.php';

class SettingsController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }

        $messages = Message::all();
        $message_array = [];

        foreach ($messages as $message) {
            $message_array[$message->category] =
                [
                    'content' => $message->content,
                    'id' => $message->id_message
                ];
        }

        try {
            $limit_dates = LimitDate::find(1); // theres only one table of limit dates
        } catch (ModelNotFoundException $notFound) {
            // handle here when the limit dates are not found
            $limit_dates = LimitDate::create(
                [
                    'id_date' => 1,
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d')
                ]
            );
            // creating the limit dates in the database

        }

        $sessions = Session::all();


        render_view('settings', [
            'messages' => $message_array,
            'limit_dates' => $limit_dates,
            'sessions' => $sessions,
            'selected' => 'settings'
        ], 'Settings');
    }



    /**
     * Updates all the messages in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateMessage($request_method)
    {
        if ($request_method == 'POST') {
            $message = Message::find($_POST['id']);

            // update the message and save it to the database
            $message->update(['content' => $_POST['content']]);
        }
        $_SESSION['message'] = 'Se ha editado el mensaje exitosamente';
        redirect('/admin/settings');
    }


    /**
     * Updates the limit dates in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateLimitDate($request_method)
    {
        if ($request_method == 'POST') {
            $limit_date = LimitDate::find(1);
            // update the message and save it to the database
            $limit_date->update(['start_date' => $_POST['startDate'], 'end_date' => $_POST['endDate']]);
        }

        $_SESSION['message'] = 'Se han editado las fechas límite exitosamente';
        redirect('/admin/settings');
    }
    public static function updateSession($request_method)
    {
        // NOTE: Need to cleanup this code
        if ($request_method === 'POST') {
            // Retrieve the session data from the POST request
            $sessions = $_POST['sessions'] ?? null;
            $new_sessions = $_POST['new_sessions'] ?? [];
            $delete_session_id = $_POST['delete_session'] ?? null;
            if ($delete_session_id) {
                try {
                    $session = Session::find((int)$delete_session_id);

                    if ($session) {
                        $session->delete(); // Call the new delete method
                    }
                } catch (ModelNotFoundException $e) {
                    $_SESSION['error'] = "No se puede eliminar un record no existente";
                }

                // Redirect back to the sessions page after deleting
                redirect('/admin/settings');
            }
            if (!$sessions && !$new_sessions) {
                $_SESSION['error'] = "Ha ocurrido un error.";
                redirect('/admin/settings');
            }
            try {
                // Update existing sessions
                if ($sessions) {
                    foreach ($sessions as $session_data) {
                        // Validate required fields for existing sessions
                        if (empty($session_data['id']) || empty($session_data['title']) || empty($session_data['start_date']) || empty($session_data['end_date'])) {
                            continue; // Skip invalid entries
                        }

                        // Fetch the session using its ID
                        $session = Session::find((int)$session_data['id']);

                        if ($session) {
                            // Update session data
                            $session->update([
                                'title' => htmlspecialchars($session_data['title']),
                                'start_date' => htmlspecialchars($session_data['start_date']),
                                'end_date' => htmlspecialchars($session_data['end_date']),
                            ]);
                        }
                    }
                }
                // Create new sessions
                if ($new_sessions) {
                    foreach ($new_sessions as $new_session_data) {
                        // Validate required fields for new sessions
                        if (empty($new_session_data['title']) || empty($new_session_data['start_date']) || empty($new_session_data['end_date'])) {
                            continue; // Skip invalid entries
                        }

                        // Create a new session
                        Session::create([
                            'title' => htmlspecialchars($new_session_data['title']),
                            'start_date' => htmlspecialchars($new_session_data['start_date']),
                            'end_date' => htmlspecialchars($new_session_data['end_date']),
                        ]);
                    }
                }

                //$_SESSION['success_message'] = "Sessions updated and new sessions created successfully.";
            } catch (Exception $e) {
                $_SESSION['error'] = "An error occurred: " . $e->getMessage();
            }
            // Redirect back to the sessions page
            $_SESSION['message'] = 'Se han editado las sesiones exitosamente';
            redirect('/admin/settings');
        }
        redirect('/admin/settings');
    }

    /**
     * Creates a new admin user in the database using the data provided in the POST request.
     * If the request method is not POST, it redirects to the settings page with an error message.
     * If the user is created successfully, it redirects to the settings page with a success message.
     * If there is an error while creating the user, it redirects to the settings page with an error message.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function createAdmin($request_method)
    {
        if ($request_method == 'POST') {

            // Check if the password and confirm password fields match
            if ($_POST['password'] !== $_POST['password_confirmation']) {
                $_SESSION['error'] = 'Las contraseñas no coinciden';
                redirect('/admin/settings');
            }

            if (User::exists(['email' => $_POST['email']])) {
                $_SESSION['error'] = 'El correo ya existe';
                redirect('/admin/settings');
            }

            $user = User::create([
                'first_name' => $_POST['first_name'],
                'last_name' => $_POST['last_name'],
                'email' => $_POST['email'],
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                'type' => 'admin',
            ]);

            if ($user) {
                $_SESSION['message'] = 'Se ha creado el administrador exitosamente';
                redirect('/admin/settings');
            } else {
                $_SESSION['error'] = 'Error al crear el administrador';
                redirect('/admin/settings');
            }
        }
        // disallow other request methods only post will be valid
        $_SESSION['error'] = 'Página no encontrada';
        redirect('/admin/settings');
    }


    /**
     * Deletes all denied user requests and the users themselves.
     *
     * Checks if the request method is POST and if the user is an admin.
     * If everything is valid, it calls the UserisDeniedDeletion method in the Application model.
     * If the deletion is successful, it sets a success message; otherwise, it sets an error message.
     * Finally, it redirects to the settings page.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function deleteRejectedRequests($request_method)
    {
        if ($request_method !== 'POST') {
            $_SESSION['error'] = 'Método no permitido.';
            redirect('/admin/settings');
        }

        if (!Auth::check() || Auth::user()->type !== 'admin') {
            $_SESSION['error'] = 'Acceso no autorizado.';
            redirect('/login');
        }

        try {
            // Llama a la función en el modelo Application
            $deletedUsers = Application::UserisDeniedDeletion();
            $users = User::allApplicants();


            if (!empty($deletedUsers)) {
                $_SESSION['message'] = count($deletedUsers) . ' solicitudes denegadas eliminadas exitosamente.';
            } else {
                $_SESSION['message'] = 'No se encontraron solicitudes denegadas para eliminar.';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Ocurrió un error al eliminar solicitudes denegadas: ' . $e->getMessage();
        } finally {

            if (empty($users)) {
                $_SESSION['message'] = 'No se encontraron solicitudes para eliminar.';
            }
        }

        redirect('/admin/settings');
    }

    public static function deleteAllRequests($request_method)

    {
        if ($request_method !== 'POST') {
            $_SESSION['error'] = 'Método no permitido.';
            redirect('/admin/settings');
        }
        if (!Auth::check() || Auth::user()->type !== 'admin') {
            $_SESSION['error'] = 'Acceso no autorizado.';
            redirect('/login');
        }

        try {
            // Llama a la función en el modelo Application
            $deletedUsers = Application::DeletionOfAllApplications();

            if (!empty($deletedUsers)) {
                $_SESSION['message'] = count($deletedUsers) . ' solicitudes eliminadas exitosamente.';
            } else {
                $_SESSION['message'] = 'No se encontraron solicitudes para eliminar.';
            }
        } catch (Exception $e) {
            $_SESSION['error'] = 'Ocurrió un error al eliminar solicitudes: ' . $e->getMessage();
        }

        redirect('/admin/settings');
    }

    public static function deleteUser($request)
    {
        if ($request !== 'POST') {

            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

            try {
                $user = User::find($user_id);
            } catch (ModelNotFoundException $notFound) {
                $_SESSION['error'] = 'El usuario no existe.';
                redirect('/admin/settings');
            }

            $user->delete();
            $_SESSION['message'] = 'El usuario ha sido eliminado exitosamente.';
            redirect('/admin/settings');
            
        }
        if (!Auth::check() || Auth::user()->type !== 'admin') {
            $_SESSION['error'] = 'Acceso no autorizado.';
            redirect('/login');
        }
    }
}

<?php
require_once 'Controller.php';
require_once 'app/models/Message.php';
require_once 'app/models/Audit.php';
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

        // default images
        $defaultImages = [
            1 => 'img/cow-2.jpeg',
            2 => 'img/doggo-checkup-2.jpeg',
            3 => 'img/microscopes-2.jpeg',
            4 => 'img/group-looking-away-2.jpeg',
        ];

        $customImages = [];

        for ($i = 1; $i <= 4; $i++) {
            // resources/assets/img/homePage/
            $pathToAssets = realpath(__DIR__ . '/../../resources/assets/img/homePage');

            if ($pathToAssets === false) {
                $customImages[$i] = $defaultImages[$i];
                continue;
            }

            // search picture 
            $pattern = $pathToAssets . "/picture{$i}.*";
            $files = glob($pattern);

            if (!empty($files)) {
                $extension = pathinfo($files[0], PATHINFO_EXTENSION);
                $customImages[$i] = 'img/homePage/picture' . $i . '.' . $extension;
            } else {
                $customImages[$i] = $defaultImages[$i];
            }
        }
        // For test path
        //dd($customImages);


        render_view('settings', [
            'messages' => $message_array,
            'limit_dates' => $limit_dates,
            'sessions' => $sessions,
            'selected' => 'settings',
            'customImages' => $customImages
        ], 'Ajustes');
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
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $content = filter_input(INPUT_POST, 'content', FILTER_DEFAULT);
            $category = filter_input(INPUT_POST, 'category', FILTER_DEFAULT);

            if (!$content || !$category) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect('/admin/settings');
            }

            try {
                $message = Message::find($id);
                // update the message and save it to the database
                $message->update(['content' => $content]);
            } catch (ModelNotFoundException $notFound) {
                // handle here when the message is not found
                Message::create(
                    [
                        'content' => $content,
                        'category' => $category
                    ]
                );
            }
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
        Audit::register('Actualizó las fechas límite', 'update');

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

            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');
            $email = filter_input(INPUT_POST, 'email');
            $password = filter_input(INPUT_POST, 'password');
            $confirm_password = filter_input(INPUT_POST, 'password_confirmation');
            $notify_email = filter_input(INPUT_POST, 'notify');

            if ($first_name == null || $last_name == null || $email == null || $password == null || $confirm_password == null) {
                $_SESSION['error'] = 'Por favor llene todos los campos';
                redirect('/admin/settings');
            }

            if ($password !== $confirm_password) {
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

            if ($notify_email) {

                $email_body = "Se te ha registrado como administrador en VETCAMP. Tus credenciales de acceso son: \nCorreo: $user->email \nContraseña: $password\n\nPuedes editar tus datos de acceso en tu perfil.";

                Mailer::send($user->email, 'Vetcamp | Eres administrador', $email_body);
            }

            if ($user) {
                $_SESSION['message'] = 'Se ha creado el administrador exitosamente';

                Audit::register("Creó el administrador {$user->first_name} {$user->last_name} ({$user->email}).", 'create');
            } else {
                $_SESSION['error'] = 'Error al crear el administrador';
            }
            redirect('/admin/settings');
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

                // log the action
                Audit::register('Eliminó ' . count($deletedUsers) . ' solicitudes denegadas.', 'delete');
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

                Audit::register('Eliminó todas las ' . count($deletedUsers) . ' solicitudes.', 'delete');
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

            $delete_id = rand(10000, 99999);

            // finally delete the user
            $user->update([
                'deleted_at' => date('Y-m-d H:i:s'),
                'first_name' => 'deleted',
                'last_name' => 'user-' . $delete_id,
                'email' => 'deleted-user-' . $delete_id,
                'status' => 'disabled',
                'phone_number' => null,
                'type' => 'deleted'
            ]);

            $_SESSION['message'] = 'El usuario ha sido eliminado exitosamente.';
            redirect('/admin/settings');
        }
        if (!Auth::check() || Auth::user()->type !== 'admin') {
            $_SESSION['error'] = 'Acceso no autorizado.';
            redirect('/login');
        }
    }

    public static function editPictureInHomePage($method)
    {
        if ($method === 'POST') {
            $selectedPicture = (int)($_POST['selected_slot'] ?? 0);
            // validation of the slot
            if ($selectedPicture < 1 || $selectedPicture > 4) {
                $_SESSION['error'] = "Slot inválido.";
                redirect('/admin/settings');
                return;
            }

            if (isset($_POST['delete_image']) && $selectedPicture) {
                $deleted = deleteAssetFileByPattern("img/homePage/picture{$selectedPicture}.*");

                if ($deleted) {
                    $_SESSION['message'] = "Imagen eliminada correctamente.";
                } else {
                    $_SESSION['error'] = "No se encontró una imagen para eliminar.";
                }

                redirect('/admin/settings');
                return;
            }

            if (!isset($_FILES['uploaded_image']) || $_FILES['uploaded_image']['error'] !== UPLOAD_ERR_OK) {
                $_SESSION['error'] = "Error al subir la imagen.";
                redirect('/admin/settings');
                return;
            }

            $maxSize = to_byte_size("8MB");

            if ($_FILES['uploaded_image']['size'] > $maxSize) {
                $uploadedSize = sizeReadable($_FILES['uploaded_image']['size']);
                $_SESSION['error'] = "El archivo excede el tamaño máximo permitido (8 MB). Tamaño recibido: {$uploadedSize}.";
                redirect('/admin/settings');
                return;
            }


            $fileTmp = $_FILES['uploaded_image']['tmp_name'];
            $fileName = $_FILES['uploaded_image']['name'];
            // Check extension based on content
            $fileType = mime_content_type($fileTmp);
            $allowedTypes = ['image/jpeg' => 'jpg', 'image/png' => 'png', 'image/webp' => 'webp'];

            if (!array_key_exists($fileType, $allowedTypes)) {
                $_SESSION['error'] = "Tipo de archivo no permitido.";
                redirect('/admin/settings');
                return;
            }

            $uploadDir = realpath(__DIR__ . '/../../resources/assets/img/homePage');
            if (!$uploadDir) {
                $_SESSION['error'] = "Directorio de destino no válido.";
                redirect('/admin/settings');
                return;
            }

            $ext = $allowedTypes[$fileType];
            $filePath = $uploadDir . "/picture{$selectedPicture}." . $ext;

            // Delete old version
            foreach ($allowedTypes as $extToDelete) {
                $oldFile = $uploadDir . "/picture{$selectedPicture}." . $extToDelete;
                if (file_exists($oldFile)) {
                    unlink($oldFile);
                }
            }

            if (!move_uploaded_file($fileTmp, $filePath)) {
                $_SESSION['error'] = "No se pudo guardar la imagen.";
                redirect('/admin/settings');
                return;
            }

            $_SESSION['message'] = "Imagen fue subida correctamente.";
            redirect('/admin/settings');
        }
    }
}

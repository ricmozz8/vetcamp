<?php
require_once 'Controller.php';
require_once 'app/models/Application.php';

class MessagesController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function mailUsers($method)
    {

        if (!Auth::check() || Auth::user()->type !== 'admin') {
            redirect('');
        }

        if ($method === 'GET') {
            redirect('/admin');
        } else if ($method === 'POST') {

            $message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);
            $type = filter_input(INPUT_POST, 'user_type', FILTER_DEFAULT);

            if (!$message || !$type) {
                $_SESSION['error'] = 'Por favor llene todos los campos';
                redirect('/admin');
            }

            if (!in_array($type, ['all', 'approved', 'denied', 'waitlist', 'applicants', 'interested'])) {
                $_SESSION['error'] = 'Hubo un error al enviar el correo';
                redirect('/admin');
            }

            self::mailAllUsers($message, $type);
        }
    }

    /**
     * Message a particular user
     *
     * @param $method the method of the request (either POST/GET)
     *
     * @return null it redirects back to the previous view (REQUEST_REFERRER)
     */
    public static function message($method)
    {
        if (!Auth::check()) // this means this resource needs authentication
            redirect_back();

        if (Auth::user()->type !== 'admin') // only allow admins
            redirect('/admin');

        if ($method === 'POST') {
            // getting all the form data from the view
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_DEFAULT);
            $message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

            if (!$user_id || !$message) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect('/admin');
            }

            try {
                $user = User::find($user_id);
            } catch (ModelNotFoundException $e) { // if we try to send a message to a non-existent user
                $_SESSION['error'] = 'No se ha encontrado el usuario';
                redirect('/admin');
            }

            // Sending the email to the user
            Mailer::send($user->email, 'Mensaje de ' . Auth::user()->first_name . '@ ' . 'Vetcamp', $message);

            $_SESSION['message'] = 'Mensaje enviado exitosamente'; // let know the user that the message was sent

            redirect('/admin');
        } else {
            redirect('/admin');
        }
    }

    /**
     * Send an email to all users with the given subject
     *
     * @param string $subject The subject of the email
     *
     * @return void
     */
    private static function mailAllUsers($message, $type)
    {
        $applications = Application::all();
        $users = [];
        $typeEs = '';

        if (empty($applications)) {
            $_SESSION['error'] = 'No hay solicitudes para enviar el correo';
            redirect('/admin');
        }

        switch ($type) {
            case 'all':
                $users = User::allof('user');
                $typeEs = 'usuarios';       
                break;
            case 'approved':
                foreach ($applications as $application) {
                    if ($application->status === Application::$statusParsings['approved']) {
                        $users[] = $application->user();
                    }
                }
                $typeEs = 'aceptados';
                break;
            case 'denied':
                foreach ($applications as $application) {
                    if ($application->status === Application::$statusParsings['denied']) {
                        $users[] = $application->user();
                    }
                }
                $typeEs = 'rechazados';
                break;
            case 'applicants':
                foreach ($applications as $application) {
                    if ($application->status === Application::$statusParsings['submitted']) {
                        $users[] = $application->user();
                    }
                }
                $typeEs = 'solicitantes';
                break;
            case 'waitlist':
                foreach ($applications as $application) {
                    if ($application->status === Application::$statusParsings['waitlist']) {
                        $users[] = $application->user();
                    }
                }
                $typeEs = 'de la lista de espera';
                break;
            case 'interested':
                foreach ($applications as $application) {
                    if (!$application->isComplete() && $application->status === Application::$statusParsings['unsubmitted']) {
                        $users[] = $application->user();
                    }
                }
                $typeEs = 'interesados';
                break;
            default:
                break;
        }

        if (empty($users)) {
            $_SESSION['error'] = 'No hay ' . $typeEs . ' para enviar el correo';
            redirect('/admin');
        }

        // splitting the array of users into chunks of 30 to avoid spam flagging
        $mail_list = [];

        foreach ($users as $user) {
            $mail_list[] = $user->email;
        }

        $mail_queue = array_chunk($mail_list, 30);



        foreach ($mail_queue as $chunk) {
            $chunk_listed = implode(', ', $chunk);

            Mailer::send($chunk_listed, 'Mensaje de ' . Auth::user()->first_name . ' en ' . 'Vetcamp', $message);
        }

        $_SESSION['message'] = 'Correo electrónico enviado a todos los ' . $typeEs . '.';
        redirect('/admin');
    }


    // define your other methods here
}

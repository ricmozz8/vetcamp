<?php
require_once 'Controller.php';

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
            $type = filter_input(INPUT_POST, 'type', FILTER_DEFAULT);

            if (!$message || !$type) {
                $_SESSION['error'] = 'Por favor llene todos los campos';
                redirect('/admin');
            }

            if ($type === 'all') {
                self::mailAllUsers($message);

                $_SESSION['message'] = 'Correo electronico enviado a todos los usuarios';
                redirect('/admin');
            } else {
                $_SESSION['error'] = 'No se ha implementado esta funcionalidad';
                redirect('/admin');
            }
        }
    }

    /**
     * Send an email to all users with the given subject
     *
     * @param string $subject The subject of the email
     *
     * @return void
     */
    private static function mailAllUsers($message)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->sendEmail($message);
        }
    }

    // define your other methods here
}

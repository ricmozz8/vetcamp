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
     * Message a particular user
     * 
     * @param method the method of the request (either POST/GET)
     * 
     * @return null it redirects back to the previous view (REQUEST_REFERRER) 
     */
    public static function message($method)
    {
        if (!Auth::check()) // this means this resource needs authentication
            redirect_back();

        if (Auth::user()->type !== 'admin') // only allow admins
            redirect_back();

        if ($method === 'POST') {
            // getting all the form data from the view
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_DEFAULT);
            $message = filter_input(INPUT_POST, 'message', FILTER_DEFAULT);

            if (!$user_id || !$message) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect_back();
            }

            try {
                $user = User::find($user_id);
            } catch (ModelNotFoundException $e) { // if we try to send a message to a non-existent user
                $_SESSION['error'] = 'No se ha encontrado el usuario';
                redirect_back();
            }

            // Sending the email to the user
            Mailer::send($user->email, 'Mensaje de ' . Auth::user()->name . '@' . 'Vetcamp',  $message);

            $_SESSION['message'] = 'Mensaje enviado exitosamente'; // let know the user that the message was sent

            redirect_back();
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
    private static function mailAllUsers($message)
    {
        $users = User::all();

        // splitting the array of users into chunks of 30 to avoid spam flagging
        $mail_queue = array_chunk($users, 30);

        // sending the emails in a loop
        foreach ($mail_queue as $queue) {
            // adding a 1 second delay between each batch of 30 emails to avoid spam flagging
            sleep(1);

            // sending the email to all the users in the current batch
            foreach ($queue as $user) {
                Mailer::send($user->email, 'Mensaje del administrador', $message);
            }
        }

        
        
    }



    // define your other methods here
}

<?php
require_once 'Controller.php';

class AcceptedController extends Controller
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
        
        $approvedApplicants = User::approvedApplicants();

        // Agrupar los usuarios en tres listas según la sesión preferida
        $sessions = [
            'Sesion 1' => [],
            'Sesion 2' => [],
            'Sesion 3' => []
        ];

        foreach ($approvedApplicants as $user) {
            $sessionId = $user['id_preferred_session'];
            $sessionKey = 'Sin asignar'; // Valor por defecto en caso de error

            if ($sessionId == 1) {
                $sessionKey = 'Sesion 1';
            } elseif ($sessionId == 2) {
                $sessionKey = 'Sesion 2';
            } elseif ($sessionId == 3) {
                $sessionKey = 'Sesion 3';
            }


            $pictureObj = Application::find($user['id_application'])->getProfilePicture();
            $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

            // Agregar la información formateada
            $sessions[$sessionKey][] = [
                'user_id'   => $user['user_id'],
                'full_name' => User::find($user['user_id'])->first_name . ' ' . User::find($user['user_id'])->last_name,
                'profile_picture' => $src,
            ];
        }
        render_view('accepted', ['selected' => 'accepted', 'sessions' => $sessions], 'Aceptados');
    }
    // define your other methods here
}
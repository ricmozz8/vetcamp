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

        $sessions = [];

        foreach ($approvedApplicants as $user) {
            $sessionId = $user['id_preferred_session'];

            $pictureObj = Application::find($user['id_application'])->getProfilePicture();
            $src = "data:" . $pictureObj['type'] . ";base64," . base64_encode($pictureObj['contents']);

            // Agregar la información formateada
            $sessions['Sesion '. $sessionId][] = [
                'user_id'   => $user['user_id'],
                'full_name' => User::find($user['user_id'])->first_name . ' ' . User::find($user['user_id'])->last_name,
                'profile_picture' => $src,
            ];
        }
        render_view('accepted', ['selected' => 'accepted', 'sessions' => $sessions], 'Aceptados');
    }
    // define your other methods here
}
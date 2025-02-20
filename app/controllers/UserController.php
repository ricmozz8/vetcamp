<?php
require_once 'Controller.php';
require_once 'app/models/User.php';


class UserController extends Controller
{


    /**
     * Serves the index view.
     *
     * @return void
     * @throws ViewNotFoundException
     */
    public static function index()
    {
        if (!Auth::check()) {
            redirect('/login');
        }

        try {
            $userObject = User::find(1);
        } catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $userObject = null;
        }


        render_view('users', ['user' => $userObject], 'Users');
    }

    /**
     * Retrieves all users and renders the 'allUsers' view.
     *
     * This method fetches all user records from the database and
     * passes them to the 'allUsers' view for rendering. It provides
     * a comprehensive list of all users to be displayed.
     *
     * @return void
     * @throws ViewNotFoundException
     */
    public static function all()
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        try {
            $users = User::allof('user');
        } catch (Exception $e) {
            $users = [];
        }
        render_view('allUsers', ['users' => $users], 'All Users');
    }


    public static function update($method)
    {

        $turnaround_route = Auth::user()->type === 'admin' ? '/admin' : '/apply';


        if ($method == 'POST') {
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $first_name = filter_input(INPUT_POST, 'first_name');
            $last_name = filter_input(INPUT_POST, 'last_name');


            // validate the user is the logged user
            if (Auth::user()->user_id != $user_id) {
                $_SESSION['error'] = 'Hubo un error al actualizar el perfil';
                redirect($turnaround_route);
            }


            try {
                $user = User::find($user_id);
            } catch (ModelNotFoundException $e) {
                $_SESSION['error'] = 'Hubo un error al actualizar el perfil';
                redirect($turnaround_route);
            }


            try {
                $user_with_email = User::findBy(['email' => $email]) ;
            } catch (ModelNotFoundException $e){
                $user_with_email = null;
            }

            if ($user_with_email && $user_with_email->user_id != $user_id) {
                $_SESSION['error'] = 'Este correo ya está en uso.';
                redirect($turnaround_route);
            }


            $user->update([
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);

                $_SESSION['message'] = 'Perfil actualizado correctamente';

                // reload the new user on session
                Auth::refresh();

        }
        redirect($turnaround_route);

    }


    public static function delete($method)
    {


        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type !== 'admin') {
            redirect('/login');
        }


        if ($method !== 'POST') {
            $_SESSION['error'] = 'Acceso no autorizado';
            redirect_back();
        }


        $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);

        try {
            $user = User::find($user_id);
        } catch (ModelNotFoundException $notFound) {
            $_SESSION['error'] = 'El usuario no existe.';
            redirect_back();
        }


        if (Auth::user()->user_id === $user_id) {
            $_SESSION['error'] = 'No puedes eliminar a ti mismo.';
            redirect_back();
        }


        if ($user->type === 'admin') {
            // admins has no associated application not addresses
            $user->delete();
            redirect('/admin');
        } else {
            $application = $user->application();
            $postal_address = $user->postal_address();
            $physical_address = $user->physical_address();
            $school_address = $user->school_address();

            // go ahead and delete the user data before deleting the user
            if ($application !== null) {
                $application->hard_delete();
            }
            if ($postal_address !== null) {
                $postal_address->delete();
            }
            if ($physical_address !== null) {
                $physical_address->delete();
            }
            if ($school_address !== null) {
                $school_address->delete();
            }

            // finally delete the user
            $user->delete();
        }

        $_SESSION['message'] = 'El usuario ha sido eliminado.';
        redirect('/admin/registered');

    }

    public static function edit($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }

        render_view('profileEdit', [], 'Tu Perfil');
    }
}



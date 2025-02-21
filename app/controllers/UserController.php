<?php
require_once 'Controller.php';
require_once 'app/models/User.php';

const CONFIRMATION_TEXT = 'borrar mi cuenta';

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

        $turnaround_route = '/profile';


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
                $user_with_email = User::findBy(['email' => $email]);
            } catch (ModelNotFoundException $e) {
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

    /**
     * Shows the form to edit the profile
     * @throws ViewNotFoundException if the view file was not found
     */
    public static function edit($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }

        render_view('profileEdit', [], 'Tu Perfil');
    }

    public static function passwordChange($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }

        $turnaround_route = '/profile';

        if ($method == 'POST') {
            $old_password = filter_input(INPUT_POST, 'old_password');
            $new_password = filter_input(INPUT_POST, 'new_password');
            $confirm_password = filter_input(INPUT_POST, 'confirm_new_password');

            // check that all inputs were passed
            if ($old_password == null || $new_password == null || $confirm_password == null) {
                $_SESSION['error'] = 'Por favor, rellene todos los campos';
                redirect($turnaround_route);
            }

            // check if the password confirmation and the new password are the same
            if ($new_password !== $confirm_password) {
                $_SESSION['error'] = 'Las contraseñas no coinciden';
                redirect($turnaround_route);
            }

            if (strlen($new_password) < 8) {
                $_SESSION['error'] = 'La contraseña debe tener al menos 8 caracteres';
                redirect($turnaround_route);
            }

            if (!password_verify($old_password, Auth::user()->__get('password'))) {
                // the user entered their wrong password
                $_SESSION['error'] = 'Contraseña actual incorrecta';
                redirect($turnaround_route);
            }

            // passed all checks, update the user

            Auth::user()->update(['password' => password_hash($new_password, PASSWORD_DEFAULT)]);
            Auth::refresh();

            $_SESSION['message'] = 'Contraseña actualizada';
        }

        redirect($turnaround_route);
    }

    /**
     * Operation for when the users choose to delete their account from the site.
     * @param $method string Either GET or POST depending on the request. This method will only
     * accept the POST method. Since it is a DELETE method.
     *
     *
     **/
    public static function destroy($method)
    {


        $turnaround_route = '/profile';

        if ($method === 'POST') {

            $confirmation_text = filter_input(INPUT_POST, 'confirmation_text');

            if (!$confirmation_text || strtolower($confirmation_text) !== CONFIRMATION_TEXT) {
                $_SESSION['error'] = 'Por favor, escribe "borrar mi cuenta" en el campo de texto';
                redirect($turnaround_route);
            }

            // verify if the user is an admin or regular user
            try {
                Auth::user()->purge();
                $_SESSION['message'] = 'Tu cuenta ha sido eliminada';
            } catch (Exception $e) {
                ErrorLog::log($e->getMessage(), $e->getFile() . ' on line ' . $e->getLine(), $e->getTraceAsString());
                $_SESSION['error'] = 'Hubo un error al eliminar tu cuenta';
                redirect($turnaround_route);

            }
            // The Auth provider will log out the user automatically when the user is not found
            // if the account was not deleted then the turnaround will return to the profile
            Auth::user();


        }
    }
}



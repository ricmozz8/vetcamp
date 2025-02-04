<?php
require_once 'Controller.php';
require_once 'app/models/User.php';


class UserController extends Controller
{


    /**
     * Serves the index view.
     *
     * @return void
     */
    public static function index()
    {
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
     */
    public static function all()
    {
        $users = User::allof('user');
        render_view('allUsers', ['users' => $users], 'All Users');
    }


    /**
     * Retrieves all registered solicitants and renders the 'allSolicitants' view.
     *
     * This method fetches all solicitants from the database and
     * passes them to the 'allSolicitants' view for rendering. It provides
     * a comprehensive list of all registered solicitants to be displayed.
     *
     * @return void
     */
    public static function allApplicants()
    {
        $solicitants = User::allApplicants();
        render_view('allSolicitants', ['solicitants' => $solicitants], 'All Solicitants');
    }



    public static function update($method)
    {
        if ($method == 'POST') {
            $user_id = filter_input(INPUT_POST, 'user_id', FILTER_VALIDATE_INT);
            $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
            $first_name = filter_input(INPUT_POST, 'first_name', FILTER_DEFAULT);
            $last_name = filter_input(INPUT_POST, 'last_name', FILTER_DEFAULT);


            // validate the user is the logged user
            if (Auth::user()->__get('user_id') != $user_id) {
                $_SESSION['error'] = 'Hubo un error al actualizar el perfil';
                redirect('/admin');
            }

            $user = User::find($user_id);
            $user->update([
                'email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name
            ]);

            $_SESSION['message'] = 'Perfil actualizado correctamente';

            // reload the new user on session
            Auth::login($user);
        }

        redirect('/admin'); // if no referrer returns to admin page
    }


    public static function new()
    {

        // how to create a new user with model:

        // $newUser =User::create([
        //     'email' => 'KZGZM@example.com',
        //     'password' => password_hash('password', PASSWORD_DEFAULT),
        //     'first_name' => 'John',
        //     'last_name' => 'Doe',
        //     'phone_number' => '1234567890',
        // ]);

        $newUser = User::find(1) ?? null;
        echo json_encode($newUser);
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


        if(Auth::user()->user_id === $user_id) {
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
}



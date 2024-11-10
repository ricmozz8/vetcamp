<?php
require_once 'Controller.php';
require_once 'app/models/User.php';


class UserController extends Controller{

    
    /**
     * Serves the index view.
     *
     * @return void
     */
    public static function index() {
        try{
            $userObject = User::find(1);
        } catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $userObject = null;
        }
        

        render_view('users', ['user' => $userObject] , 'Users');
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
    public static function all() {
        $users = User::all(); // Retrieve all users
       render_view('allUsers', ['users' => $users] , 'All Users');
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
      public static function allRegistered() {
       $solicitants = User::allRegistered();
       render_view('allSolicitants', ['solicitants' => $solicitants], 'All Solicitants'); 
    }


    /**
     * Updates a user record in the database and returns the user object.
     *
     * This method updates a user record in the database and returns the user object
     * in JSON format. If the user is not found, it will return null.
     *
     * @return string|null The user object in JSON format or null if the user is not found.
     */
    public static function update()
    {
        try{
            $userObject = User::find(1);
        }  catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $userObject = null;
        }

        // $userObject->update(['primer_nombre' => 'Aoaoe Ie Ueaoe']);
        echo json_encode($userObject);

    }
    
}
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

    public static function all() {
        $users = User::all(); // Retrieve all users
       render_view('allUsers', ['users' => $users] , 'All Users');
      }


      public static function allRegistered() {
       $solicitants = User::allRegistered();
       render_view('allSolicitants', ['solicitants' => $solicitants], 'All Solicitants'); 
    }


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
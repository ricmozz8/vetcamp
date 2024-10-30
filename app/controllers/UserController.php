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
        $users = User::all();
       // dd($users);
       render_view('allSolicitants', ['users' => $users] , 'All Users');
      }


      public static function allRegistered() {
        try {
            // Retrieve all users
            $users = User::all();
            // Retrieve all applications to link each user's status

            $result = [];

            foreach ($users as $user) {
                try{
                    $application = $user->application();
                    // application found
                    $result[] = $user;
                } catch (ModelNotFoundException $notFound) {
                    continue;
                }
            }
            
            // Render the view with registered data
            render_view('allSolicitants', ['registered' => $result], 'All Users'); 
        } catch (Exception $e) {
            echo "An error occurred: " . $e->getMessage();
        }
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
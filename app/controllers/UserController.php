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
            $applications = Application::all();
    
            // Initialize an array to store the registered users with required fields
            $registered = [];
    
            // Loop through each user and match them with their application status
            foreach ($users as $user) {
                // Find the corresponding application for the user
                $application = array_filter($applications, function($app) use ($user) {
                    return $app->user_id === $user->id;
                });
                
                // Extract the status if an application exists, otherwise default to "Not Registered"
                $status = $application ? $application[0]->status : 'Not Registered';
    
                // Add the combined data to the registered array
                $registered[] = [
                    'email' => $user->email,
                    'status' => $status,
                    'created_at' => $user->created_at,
                ];
            }
    
            // Render the view with registered data
            render_view('allUsers', ['registered' => $registered], 'All Users'); 
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
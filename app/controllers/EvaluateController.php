<?php
require_once 'Controller.php';

require_once 'app/models/Application.php';

class EvaluateController extends Controller
{
    public static function index()
    {
        // your index view here

    }

    // CHANGE THESE TWO METHODS TO SETTINGS PAGE AND ADAPT TO EDIT MODAL
    /**
     * Updates all the messages in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateStatus($request_method)
    {

        if ($request_method == 'POST') {
            $application = Auth::$user->application();

            if($application == null){
            redirect('/admin');
            }
            
            if (isset($_POST['status'])) {
                $newStatus = $_POST['status'];
                $application->update(['status' => $newStatus]);
            }
        } 
        redirect('/admin');
    }
}

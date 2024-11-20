<?php
require_once 'Controller.php';

require_once 'app/models/Session.php';

class SessionController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
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
    public static function updateSession($request_method)
    {

        if ($request_method == 'POST') {
            $sessions = Session::all();
            
            foreach ($sessions as $session) {
                $session->update(
                    [
                        'title' => $_POST["session_title"],
                        'start_date' => $_POST["session_start_date"],
                        'end_date' => $_POST["session_end_date"]
                    ]);
            }
        } 

        redirect('/admin');
    }
    // ---

    // define your other methods here
}

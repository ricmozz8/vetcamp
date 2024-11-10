<?php
require_once 'Controller.php';

require_once 'app/models/Message.php';

class SettingsController extends Controller
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
     * Shows the form for all messages
     *
     * @return void
     */
    public static function editMessages()
    {
        // shows the form for all messages
        $messages = Message::all();

        render_view('predefmsg', ['messages' => $messages], 'Messages');
    }

    /**
     * Updates all the messages in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateMessages($request_method)
    {
        if ($request_method == 'POST') {
            $messages = Message::all();
            
            foreach ($messages as $message) {
                // update the message and save it to the database
                $message->update(['content' => $_POST[$message->category]]);
            }
        } 

        redirect('/admin/predefmsg');
        
    }
    // ---

    // define your other methods here
}

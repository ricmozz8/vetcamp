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
        $messages = Message::all();
        $message_array = [];

        foreach ($messages as $message) {
           $message_array[$message->category] = 
            [
                    'content' => $message->content,
                    'id' => $message->id_message
            ];     
            }


        render_view('settings', [
            'messages' => $message_array
        ], 'Settings');
    }



    /**
     * Updates all the messages in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateMessage($request_method)
    {
        if ($request_method == 'POST') {
            $message = Message::find($_POST['id']);

            // update the message and save it to the database
            $message->update(['content' => $_POST['content']]);
        }

        redirect('/admin/settings');
    }

    // ---

    // define your other methods here
}

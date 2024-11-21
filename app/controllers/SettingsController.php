<?php
require_once 'Controller.php';

require_once 'app/models/Message.php';
require_once 'app/models/LimitDate.php';

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
        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type != 'admin') {
            redirect('/login');
        }
        
        $messages = Message::all();
        $message_array = [];

        foreach ($messages as $message) {
            $message_array[$message->category] =
                [
                    'content' => $message->content,
                    'id' => $message->id_message
                ];
        }

        try {
            $limit_dates = LimitDate::find(1); // theres only one table of limit dates
        } catch (ModelNotFoundException $notFound) {
            // handle here when the limit dates are not found
            $limit_dates = LimitDate::create(
                [
                    'id_date' => 1,
                    'start_date' => date('Y-m-d'),
                    'end_date' => date('Y-m-d')
                ]
            );
            // creating the limit dates in the database

        }





        render_view('settings', [
            'messages' => $message_array,
            'limit_dates' => $limit_dates,
            'selected' => 'settings'
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


    /**
     * Updates the limit dates in the database with the new content in the corresponding POST keys.
     *
     * @param string $request_method The request method of the request.
     *
     * @return void
     */
    public static function updateLimitDate($request_method)
    {
        if ($request_method == 'POST') {
            $limit_date = LimitDate::find(1);
            // update the message and save it to the database
            $limit_date->update(['start_date' => $_POST['startDate'], 'end_date' => $_POST['endDate']]);
        }

        redirect('/admin/settings');
    }

    // ---

    // define your other methods here
}

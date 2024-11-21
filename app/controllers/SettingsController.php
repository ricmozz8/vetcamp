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

    $sessions = Session::all();
        

        render_view('settings', [
            'messages' => $message_array,
            'limit_dates' => $limit_dates,
            'sessions' => $sessions
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
    public static function updateSession($request_method)
    {
        if ($request_method === 'POST') {
            // Retrieve the session data from the POST request
            $sessions = $_POST['sessions'] ?? null;
            $new_sessions = $_POST['new_sessions'] ?? [];
            if (!$sessions && !$new_sessions) {
                $_SESSION['error_message'] = "No session data provided.";
                redirect('/admin/settings');
            }
            try {
                // Update existing sessions
                if ($sessions) {
                    foreach ($sessions as $session_data) {
                        // Validate required fields for existing sessions
                        if (empty($session_data['id']) || empty($session_data['title']) || empty($session_data['start_date']) || empty($session_data['end_date'])) {
                            continue; // Skip invalid entries
                        }

                        // Fetch the session using its ID
                        $session = Session::find($session_data['id']);

                        if ($session) {
                            // Update session data
                            $session->update([
                                'title' => htmlspecialchars($session_data['title']),
                                'start_date' => htmlspecialchars($session_data['start_date']),
                                'end_date' => htmlspecialchars($session_data['end_date']),
                            ]);
                        }
                    }
                }
                // Create new sessions
                if ($new_sessions) {
                    foreach ($new_sessions as $new_session_data) {
                        // Validate required fields for new sessions
                        if (empty($new_session_data['title']) || empty($new_session_data['start_date']) || empty($new_session_data['end_date'])) {
                            continue; // Skip invalid entries
                        }

                        // Create a new session
                        Session::create([
                            'title' => htmlspecialchars($new_session_data['title']),
                            'start_date' => htmlspecialchars($new_session_data['start_date']),
                            'end_date' => htmlspecialchars($new_session_data['end_date']),
                        ]);
                    }
                }

                $_SESSION['success_message'] = "Sessions updated and new sessions created successfully.";
            } catch (Exception $e) {
                $_SESSION['error_message'] = "An error occurred: " . $e->getMessage();
            }
            // Redirect back to the sessions page
            redirect('/admin/settings');
        }

        // Handle invalid request methods
        http_response_code(405);
        $_SESSION['error_message'] = "Invalid request method.";
        redirect('/admin/settings');
    }
    // ---

    // define your other methods here
}

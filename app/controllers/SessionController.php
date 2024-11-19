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
        if ($request_method === 'POST') {
            $sessionId = $_POST['session_id'] ?? null;
            $title = $_POST['session_title'] ?? null;
            $startDate = $_POST['session_start_date'] ?? null;
            $endDate = $_POST['session_end_date'] ?? null;

            if ($sessionId && $title && $startDate && $endDate) {
                // Use the Model's built-in update function
                $session = Session::find($sessionId);
                if ($session) {
                    $session->update([
                        'title' => $title,
                        'start_date' => $startDate,
                        'end_date' => $endDate,
                    ]);

                    // Redirect on success
                    header('Location: /admin/settings?update=success');
                    exit;
                } else {
                    // Handle case where session ID is invalid
                    header('Location: /admin/settings?error=session_not_found');
                    exit;
                }
            } else {
                // Redirect with error if required data is missing
                header('Location: /admin/settings?error=invalid_input');
                exit;
            }
        } else {
            // Redirect with error if method is not POST
            header('Location: /admin/settings?error=invalid_method');
            exit;
        }
    }
    // ---

    // define your other methods here
}

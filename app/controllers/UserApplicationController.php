<?php
require_once 'Controller.php';

class UserApplicationController extends Controller
{
    public static function index()
    {

        if (!Auth::check()) { // checks if the user is logged in
            redirect('/login');
        }
        if (Auth::user()->type == 'admin') { // redirect admins trying to access the frontend
            redirect('/admin');
        }

        $application = Auth::user()->application(); // returns null if no application is found

        $has_application = $application ? $application->status : 'Sin llenar';
        
        render_view('application/application_dashboard', [
            'has_application' => $has_application
        ], 'Aplica');
    }

    /**
     * This renders the start application view.
     *
     *
     * @return void
     */
    public static function basic_data($method)
    {
        // your index view here
         // IMPORTANT: IT IS REQUIRED TO MOVE THIS TO A CONTROLLER WHEN IMPLEMENTING FUNCTIONALITY
         if($method == 'POST'){
            $stage = filter_input(INPUT_POST, 'stage', FILTER_DEFAULT) ?? '1';

            $application = Auth::user()->application(); // can be NULL if user doesnt have a request
            $sessions = Session::all();

            $stage_info = [
                'birthdate' => Auth::user()->birthdate,
                'preferred_session' => $application->preferred_session(),
                'school_street' => Auth::user()->school_address()->street ?? '',
                'school_city' => Auth::user()->school_address()->city ?? '',
                'school_zip' => Auth::user()->school_address()->zip_code ?? '',
                'school_type' => Auth::user()->school_address()->school_type ?? '',
                'sessions' => $sessions
            ];

            render_view('application/stage1'  , ['basic_information' => $stage_info], 'Datos Básicos');
           
            
            
        } else {
            redirect('/apply');
        }

    }

    // define your other methods here
}

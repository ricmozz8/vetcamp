<?php
require_once 'Controller.php';

class UserApplicationController extends Controller
{
    /**
     * Renders the application dashboard view.
     *
     * Redirects the user to login if not logged in, or to /admin if an admin is trying to access
     * the frontend.
     *
     * @return void
     */
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
        // save the basic information here, validate it and then save it 
        if ($method === 'POST') {
            $_SESSION['message'] = 'Datos básicos guardados correctamente';
            redirect('/apply/application/contact');
        } else {
            $stage = filter_input(INPUT_POST, 'stage', FILTER_DEFAULT) ?? '1';
            $application = Auth::user()->application();
            $full_application = $application ? $application->full_application() : [];
            $sessions = Session::all();
            render_view('application/basic_info', [
                'application' => $full_application,
                'sessions' => $sessions
            ], 'Datos Básicos');
        }
    }

    /**
     * This renders the contact view.
     *
     * If the method is POST, it saves the contact information to the user's application
     * and redirects to the application dashboard.
     *
     * If the method is GET, it renders the contact view with the application's contact information
     * and all sessions available.
     *
     * @param string $method The HTTP method used to access this function.
     *
     * @return void
     */
    public static function contact($method)
    {
        // submit the contact information and validate them it here
        if ($method === 'POST') {
            $_SESSION['message'] = 'Datos de contacto guardados correctamente';
            redirect('/apply/application/documents');
        } else {
            $stage = filter_input(INPUT_POST, 'stage', FILTER_DEFAULT) ?? '1';
            $application = Auth::user()->application();
            $full_application = $application ? $application->full_application() : [];
            
            $sessions = Session::all();
            render_view('application/contact', ['application' => $full_application, 'sessions' => $sessions], 'Contacto');
        }
    }

    /**
     * This handles the document submission stage of the application process.
     *
     * If the method is POST, it saves the uploaded documents to the user's application
     * and redirects to the application dashboard.
     *
     * If the method is GET, it renders the document upload view with the application's
     * current details and all sessions available.
     *
     * @param string $method The HTTP method used to access this function.
     *
     * @return void
     */
    public static function documents($method)
    {
        // submit the documents and validate them it here

        if ($method === 'POST') {
            $_SESSION['message'] = 'Documentos guardados correctamente';
            redirect('/apply/application/confirm');
        } else {
            $stage = filter_input(INPUT_POST, 'stage', FILTER_DEFAULT) ?? '1';
            $application = Auth::user()->application();
            $full_application = $application ? $application->full_application() : [];
            $sessions = Session::all();
            render_view('application/documents', ['application' => $full_application, 'sessions' => $sessions], 'Documentos');
        }
    }

    public static function confirm($method)
    {
        // submit the application and confirm it here
        if ($method === 'POST') {
            $_SESSION['message'] = 'Aplicación sometida correctamente';
            redirect('/apply');
        } else {
            $stage = filter_input(INPUT_POST, 'stage', FILTER_DEFAULT) ?? '1';
            $application = Auth::user()->application();
            $full_application = $application ? $application->full_application() : [];
            $sessions = Session::all();
            render_view('application/confirm', ['application' => $full_application, 'sessions' => $sessions], 'Confirmar Aplicación');
        }
    }
}

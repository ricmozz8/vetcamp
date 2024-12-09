<?php
require_once 'Controller.php';
require_once 'app/models/Application.php';

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

            $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_DEFAULT);

            $user = Auth::user()->update([
                'birthdate' => $birthdate
            ]);


            $section = filter_input(INPUT_POST, 'section', FILTER_DEFAULT);

            if ($section == null) {
                $_SESSION['error'] = 'Indica la sección que deseas participar';
                redirect('/apply/application/basic_info');
            }

            $application = Auth::user()->application();

            if ($application == null) {
                $application = Application::create([
                    'user_id' => Auth::user()->__get('user_id'),
                    'id_preferred_session' => $section,
                    'status' => 'unsubmitted'
                ]);
            } else {
                $application->update([
                    'id_preferred_session' => $section,
                ]);
            }

            // school addresses
            $street = filter_input(INPUT_POST, 'school_street', FILTER_DEFAULT);
            $city = filter_input(INPUT_POST, 'city', FILTER_DEFAULT);
            $zip = filter_input(INPUT_POST, 'school_zipcode', FILTER_DEFAULT);

            // check if the user has a school address
            try {
                $school_address = Auth::user()->school_address();

                $school_address->update([
                    'street' => $street,
                    'city' => $city,
                    'zip_code' => $zip
                ]);
            } catch (ModelNotFoundException $e) {

                $school_address = SchoolAddress::create([
                    'street' => $street,
                    'city' => $city,
                    'zip_code' => $zip,
                    'user_id' => Auth::user()->__get('user_id')
                ]);
            }

            // refresh the user with the new information on the database
            Auth::refresh() ?
                $_SESSION['message'] = 'Datos básicos guardados correctamente' :
                $_SESSION['error'] = 'Hubo un error al guardar los datos básicos';

            redirect('/apply/application/contact');
        } else {
            $application = Auth::user()->application();
            $sessions = Session::all();
            try{
                $school_address  = Auth::user()->school_address();
            } catch (ModelNotFoundException $e) {
                $school_address = null;
            }

            render_view('application/basic_info', [
                'application' => $application,
                'sessions' => $sessions,
                'school_address' => $school_address
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
            $application = Auth::user()->application();
            $postal_address = Auth::user()->postal_address();
            $physical_address = Auth::user()->physical_address();

            render_view('application/contact', [
                'application' => $application,
                'postal_address' => $postal_address,
                'physical_address' => $physical_address
            ], 'Datos Básicos');
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
            $application = Auth::user()->application();

            render_view('application/documents', [
                'application' => $application,
            ], 'Datos Básicos');
        }
    }

    public static function confirm($method)
    {
        // submit the application and confirm it here
        if ($method === 'POST') {
            $_SESSION['message'] = 'Aplicación sometida correctamente';
            redirect('/apply');
        } else {
            $application = Auth::user()->application();

            render_view('application/confirm', [
                'application' => $application,
            ], 'Datos Básicos');
        }
    }
}

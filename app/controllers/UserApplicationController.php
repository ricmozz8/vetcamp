<?php
require_once 'Controller.php';
require_once 'app/models/Application.php';

class UserApplicationController extends Controller
{

    /**
     * Validates if the current time is within the limit dates.
     *
     * @return boolean True if the current time is within the limit dates, false otherwise.
     * @throws DateMalformedStringException
     * @throws ModelNotFoundException
     */
    private static function validate_time_limit(): bool
    {
        $limit_date = LimitDate::find(1);
        $start = new DateTime($limit_date->start_date);
        $end = new DateTime($limit_date->end_date);



        $now = new DateTime(date('Y-m-d'));

        if ($now > $end || $now < $start) {
            return false;
        }
        return true;
    }


    public static function getPrintableApplication()
    {
        if (!Auth::check()) { // checks if the user is logged in
            redirect('/login');
        }
        if (Auth::user()->type == 'admin') { // redirect admins trying to access the frontend
            redirect('/admin');
        }

        if (Auth::user()->application() == null) {
            redirect('/apply/application/basic_info');
        }

        if (Auth::user()->postal_address() == null) {
            redirect('/apply/application/basic_info');
        }

        if (Auth::user()->physical_address() == null) {
            redirect('/apply/application/basic_info');
        }

        if (Auth::user()->school_address() == null) {
            redirect('/apply/application/basic_info');
        }

        if (Auth::user()->application()->shirt_size === null) {
            redirect('/apply/application/basic_info');
        }



        render_view('document', [], 'Solicitud');
    }

    /**
     * Renders the application dashboard view.
     *
     * Redirects the user to login if not logged in, or to /admin if an admin is trying to access
     * the frontend.
     *
     * @return void
     * @throws DateMalformedStringException
     * @throws ModelNotFoundException
     * @throws ViewNotFoundException
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
            'has_application' => $has_application,
            'can_apply' => self::validate_time_limit()
        ], 'Aplica');
    }

    /**
     * This renders the start application view.
     *
     *
     * @param $method
     * @return void
     * @throws DateMalformedStringException
     * @throws ModelNotFoundException
     * @throws ViewNotFoundException
     */
    public static function basic_data($method)
    {

        if (!self::validate_time_limit()) {
            $_SESSION['error'] = 'Las solicitudes no estan disponibles en este momento.';
            redirect('/apply');
        }

        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type == 'admin') {
            redirect('/admin');
        }

        $application = Auth::user()->application();
        $school_address  = Auth::user()->school_address();

        // save the basic information here, validate it and then save it 
        if ($method === 'POST') {

            $birthdate = filter_input(INPUT_POST, 'birthdate', FILTER_DEFAULT);

            if ($birthdate == null) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect('/apply/application/basic_info');
            }

            $shirtSize = filter_input(INPUT_POST, 'shirtsize', FILTER_DEFAULT);

            if ($shirtSize == null) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect('/apply/application/basic_info');
            }


            Auth::user()->update([
                'birthdate' => $birthdate,

            ]);

            $section = filter_input(INPUT_POST, 'section', FILTER_DEFAULT);


            if ($section == null) {
                $_SESSION['error'] = 'Indica la sección que deseas participar';
                redirect('/apply/application/basic_info');
            }

            $application = Auth::user()->application();

            if ($application == null) {
                Application::create([
                    'user_id' => Auth::user()->__get('user_id'),
                    'id_preferred_session' => $section,
                    'status' => 'unsubmitted',
                    'shirt_size' => $shirtSize
                ]);
            } else {
                $application->update([
                    'id_preferred_session' => $section,
                    'shirt_size' => $shirtSize
                ]);
            }

            // school addresses
            $street = filter_input(INPUT_POST, 'school_street', FILTER_DEFAULT);
            $city = filter_input(INPUT_POST, 'city', FILTER_DEFAULT);
            $zip = filter_input(INPUT_POST, 'school_zipcode', FILTER_DEFAULT);

            $school_type = filter_input(INPUT_POST, 'schoolType', FILTER_DEFAULT);

            // check if the user has a school address and save it

            $newAddress = [
                'street' => $street,
                'city' => $city,
                'zip_code' => $zip,
                'school_type' => $school_type
            ];

            if ($school_address === null) {
                $newAddress['user_id'] = Auth::user()->__get('user_id');
                SchoolAddress::create($newAddress);
            } else {
                $school_address->update($newAddress);
            }

            // refresh the user with the new information on the database
            Auth::refresh() ?
                $_SESSION['message'] = 'Datos básicos guardados correctamente' :
                $_SESSION['error'] = 'Hubo un error al guardar los datos básicos';

            redirect('/apply/application/contact');
        } else {

            $sessions = Session::all();
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
        if (!self::validate_time_limit()) {
            $_SESSION['error'] = 'Las solicitudes no estan disponibles en este momento.';
            redirect('/apply');
        }

        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type == 'admin') {
            redirect('/admin');
        }


        $application = Auth::user()->application();
        $postal_address = Auth::user()->postal_address();
        $physical_address = Auth::user()->physical_address();

        if ($application === null) { // the user must have submitted their basic information first
            $_SESSION['error'] = 'Por favor complete todos los campos';
            redirect('/apply/application/basic_info');
        }

        // submit the contact information and validate them it here
        if ($method === 'POST') {

            // obtaining the contact information

            $physical_addr_data = [
                'aline1' => filter_input(INPUT_POST, 'physical_aline1', FILTER_DEFAULT),
                'aline2' => filter_input(INPUT_POST, 'physical_aline2', FILTER_DEFAULT),
                'city' => filter_input(INPUT_POST, 'physical_city', FILTER_DEFAULT),
                'zip_code' => filter_input(INPUT_POST, 'physical_zip', FILTER_DEFAULT),
            ];

            $postal_addr_data = [
                'aline1' => filter_input(INPUT_POST, 'postal_aline1', FILTER_DEFAULT),
                'aline2' => filter_input(INPUT_POST, 'postal_aline2', FILTER_DEFAULT),
                'city' => filter_input(INPUT_POST, 'postal_city', FILTER_DEFAULT),
                'zip_code' => filter_input(INPUT_POST, 'postal_zip', FILTER_DEFAULT),
            ];



            $isValid =
                validate_input($physical_addr_data, ['aline1', 'city', 'zip']) &&
                validate_input($postal_addr_data, ['aline1', 'city', 'zip']);

            // do not let the user continue if there are errors
            if (!$isValid) {
                $_SESSION['error'] = 'Por favor complete todos los campos';
                redirect('/apply/application/contact');
            }

            // updating the user's addresses
            if ($physical_address === null) {
                $physical_addr_data['user_id'] = Auth::user()->__get('user_id');
                $physical_address = PhysicalAddress::create($physical_addr_data);
            } else {
                $physical_address->update($physical_addr_data);
            }

            if ($postal_address === null) {
                $postal_addr_data['user_id'] = Auth::user()->__get('user_id');
                $postal_address = PostalAddress::create($postal_addr_data);
            } else {
                $postal_address->update($postal_addr_data);
            }

            // refresh the user with the new information on the database
            Auth::refresh() ?
                $_SESSION['message'] = 'Datos de contacto guardados correctamente' :
                $_SESSION['error'] = 'Hubo un error al guardar los datos de contacto';

            redirect('/apply/application/documents');
        } else {


            render_view('application/contact', [
                'application' => $application,
                'postal_address' => $postal_address,
                'physical_address' => $physical_address
            ], 'Datos de Contacto');
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
    public static function documents(string $method)
    {

        $application = self::getApplication();

        if ($method === 'POST') {

            if (empty($_FILES)) {
                $_SESSION['message'] = 'Debes subir los documentos antes de someter la solicitud.';
                redirect('/apply/application/confirm');
            }

            // getting all documents
            $documents = [
                'written_application' => $_FILES['written_application'],
                'transcript' => $_FILES['transcript'],
                'written_essay' => $_FILES['written_essay'],
                'picture' => $_FILES['picture'],
                'video_essay' => $_FILES['video_essay'],
                'authorization_letter' => $_FILES['authorization_letter'],
                'recommendation_letter' => $_FILES['recommendation_letter'],
            ]; // important that these names are the same as the ones in the view and the database (Without the `url_`)

            // validating the documents (note: create a validate_documents function)
            $valid =
                validate_documents($documents, [
                    'written_application' => ['type' => ['application/pdf'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'transcript' => ['type' => ['application/pdf'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'written_essay' => ['type' => ['application/pdf'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'picture' => ['type' => ['image/jpeg', 'image/png', 'image/jpg'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'video_essay' => ['type' => ['video/mp4'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'authorization_letter' => ['type' => ['application/pdf'], 'size' => to_byte_size('10MB'), 'required' => false],
                    'recommendation_letter' => ['type' => ['application/pdf'], 'size' => to_byte_size('10MB'), 'required' => false]
                ]);


            // if the user has not uploaded any documents
            if (!$application->isComplete() && $valid['result'] === DOCUMENTS_OK && empty($valid['validated'])) {
                $_SESSION['message'] = 'Te faltan algunos documentos por subir.';
                redirect('/apply/application/confirm');
            }

            // do not let the user continue if there are errors
            if ($valid['result'] === DOCUMENTS_NOT_VALID) {
                $_SESSION['error'] = $valid['message'];
                redirect('/apply/application/documents');
            }

            // saving the documents
            foreach ($valid['validated'] as $key => $document) {
                $source_folder = 'documents/submissions/' . Auth::user()->__get('user_id');

                // getting the extension
                $extension = pathinfo($document['name'], PATHINFO_EXTENSION);
                $destination = $source_folder . '/' . $key . '.' . $extension;


                Storage::store('private', $destination, file_get_contents($document['tmp_name']));

                $application->update([
                    "url_$key" => $destination
                ]);
            }

            // refresh the user with the new information on the database
            Auth::refresh();

            $_SESSION['message'] = 'Documentos guardados correctamente';
            redirect('/apply/application/confirm');
        } else {
            // method is GET

            $saved_documents = $application->getDocuments();

            render_view('application/documents', [
                'application' => $application,
                'saved_documents' => $saved_documents
            ], 'Documentos');
        }
    }

    /**
     * This handles the delete for documents.
     *
     * If the method is POST,  get the name document, with name make the path.
     *
     * If the method is GET, it renders the document upload view with the application's
     * current details and all sessions available.
     *
     * @param string $method The HTTP method used to access this function.
     *
     * @return void
     */
    public static function deleteDocuments(string $method)
{
    $application = self::getApplication();

    if ($method === 'POST') {
        if (!empty($_POST['file_name'])) {
            // variables needed for the call
            $fileName = $_POST['file_name'];
            $disk = "private";
            $userId = Auth::user()->user_id;
            $filePath = "documents/submissions/$userId/$fileName";

            try {
                Storage::delete($disk, $filePath);
                echo "Archivo eliminado correctamente: $fileName";
            } catch (Exception $e) {
                echo "Error al eliminar archivo: " . $e->getMessage();
            }

        } else {
            echo "No hay archivo para eliminar.";
        }

        // refresh the user with the new information on the database
        Auth::refresh();

        $_SESSION['message'] = 'Documentos eliminados correctamente';
        redirect('/apply/application/documents');
    } else {
        // method is GET
        $saved_documents = $application->getDocuments();

        render_view('application/documents', [
            'application' => $application,
            'saved_documents' => $saved_documents
        ], 'Documentos');
    }
}

    public static function confirm($method)
    {
        $application = self::getApplication();
        // submit the application and confirm it here

        if ($method === 'POST') {

            // Validate here that every information is valid before sumbitting

            $extra_notes = filter_input(INPUT_POST, 'extra_info');

            if (empty($extra_notes)) {
                $extra_notes = '';
            }

            if ($application->status == 'submitted') {
                $_SESSION['message'] = 'Aplicación actualizada correctamente';
                redirect('/apply');
            }

            if (!$application->isComplete()) {
                $_SESSION['error'] = 'Tienes información sin llenar, las solicitudes incompletas no serán aprobadas.';
                redirect('/apply/application/confirm');
            }



            $application->update([
                'status' => 'submitted',
                'extra_notes' => $extra_notes
            ]);

            Mailer::send(
                Auth::user()->email,
                'Solicitud de Aplicación',
                'Tu solicitud ha sido sometida correctamente.'
            );

            $_SESSION['message'] = 'Aplicación sometida correctamente';
            redirect('/apply');
        } else {
            $application = Auth::user()->application();
            render_view('application/confirm', [
                'application' => $application,
            ], 'Confirmar');
        }
    }

    /**
     * Retrieves the current user's application, validating access and ensuring prerequisites are met.
     *
     * Redirects the user if the time limit for applications is not valid,
     * if the user is not logged in, or if the user is an admin attempting to access the frontend.
     * If no application is found, prompts the user to complete required fields.
     *
     * @return Application|null The user's application if found and accessible, or redirects the user.
     * @throws DateMalformedStringException If date parsing errors occur.
     * @throws ModelNotFoundException If the required model data is not found.
     */
    public static function getApplication(): ?Application
    {
        if (!self::validate_time_limit()) {
            $_SESSION['error'] = 'Las solicitudes no estan disponibles en este momento.';
            redirect('/apply');
        }


        if (!Auth::check()) {
            redirect('/login');
        }

        if (Auth::user()->type == 'admin') {
            redirect('/admin');
        }

        $application = Auth::user()->application();
        if ($application === null) {
            $_SESSION['error'] = 'Por favor complete todos los campos';
            redirect('/apply/application/basic_info');
        }
        return $application;
    }
}

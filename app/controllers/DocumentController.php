<?php
require_once 'Controller.php';

class DocumentController extends Controller
{

    const VALID_DOCUMENT_NAMES = [
        'written_essay',
        'video_essay',
        'written_application',
        'transcript',
        'authorization_letter',
        'recommendation_letter',
        'picture'
    ]; 

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index($application, $document)
    {
        
        try {
            $application = Application::find($application);
            $documents = $application->getSubmittedDocuments();

        } catch (ModelNotFoundException $notFound) {
            // handle here when the user is not found
            $_SESSION['error'] = "No se encontró la solicitud con el ID proporcionado.";
            redirect('/admin/requests');
        }

        if ($document == null) {
            $_SESSION['error'] = "No se encontró el documento.";
            redirect('/admin/requests');
        }

        if (!in_array($document, self::VALID_DOCUMENT_NAMES)) {
            $_SESSION['error'] = "No se encontró el documento.";
            redirect('/admin/requests');
        }

        if ($documents == null) {
            $_SESSION['error'] = "El usuario no ha subido documentos.";
            redirect('/admin/requests');
        }

        if(!in_array($document, array_keys($documents))) {
            $_SESSION['error'] = "No se encontró el documento.";
            redirect('/admin/requests');
        }
        $requested_document_url = $documents[$document];

        if ($requested_document_url == null) {
            $_SESSION['error'] = "No se encontró el documento.";
            redirect('/admin/requests');
        }

        $requested_document = Storage::get_metadata('private', $requested_document_url);

        // got the document url, rendering the document in place without views
        
        header('Content-Type: ' . $requested_document['type']);
        header('Content-Disposition: inline; filename="' . $requested_document['name'] . '"');
        header('Content-Length: ' . $requested_document['size']);

        echo $requested_document['contents'];

        exit;



    }

    // define your other methods here
}

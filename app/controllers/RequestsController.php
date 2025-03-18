<?php
require_once 'Controller.php';

class RequestsController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index($method)
    {
        if (!Auth::check()) {
            redirect('/login');
        }
        if (Auth::user()->type !== 'admin') {
            redirect('/login');
        }

        $order = isset($_GET['order']) && in_array($_GET['order'], ['asc', 'desc']) ? $_GET['order'] : 'desc';
        $doc_order = isset($_GET['doc']) && in_array($_GET['doc'], ['asc', 'desc']) ? $_GET['doc'] : null;
        $s = filter_input(INPUT_GET, 'search', FILTER_DEFAULT);


        $application_status = filter_input(INPUT_GET, 's', FILTER_VALIDATE_INT) ?: 0;
        

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perPage = 6; // Set the number of users per page
        
        // Get all applicants with the users included
        $allApplicants = Application::allWith('users', 'user_id', ['status'=>'status']);

        // Calculate total pages
        $totalUsers = count($allApplicants);
        $totalPages = ceil($totalUsers / $perPage);

        // Ensure the current page is within bounds
        $page = max(1, min($page, $totalPages));

        // Get the slice of users for the current page
        $offset = ($page - 1) * $perPage;

        $arrayUsers = [];
        
        // filtrar las solicitudes
        foreach ($allApplicants as $application) {

            switch ($application_status) {
                case 1:
                    if($application->status == "Sometida") {
                        $arrayUsers[] = $application;
                    }
                    break;
                case 2:
                    if($application->status == "Necesita Cambios") {
                        $arrayUsers[] = $application;
                    }
                    break;
                case 3:
                    if($application->status == "Aceptado") {
                        $arrayUsers[] = $application;
                    }
                    break;
                case 4:
                    if($application->status == "Rechazado") {
                        $arrayUsers[] = $application;
                    }
                    break;
                case 5:
                    if($application->status == "Incompleta") {
                        $arrayUsers[] = $application;
                    }
                    break;
                case 6:
                    if($application->status == "En lista de espera") {
                        $arrayUsers[] = $application;
                    }
                    break;
                default:
                    $arrayUsers = $allApplicants;
                    break;
            }
        }

        usort($arrayUsers, function ($a, $b) use ($order, $doc_order) {
            $dateA = strtotime($a->date_created);
            $dateB = strtotime($b->date_created);
        
            // Ordenar primero por fecha
            $dateComparison = $order === 'asc' ? $dateA - $dateB : $dateB - $dateA;
        
            if ($doc_order) {
                $docA = $a->documentCount();
                $docB = $b->documentCount();
                $docComparison = $doc_order === 'asc' ? $docA - $docB : $docB - $docA;
                return $docComparison !== 0 ? $docComparison : $dateComparison;
            }
        
            return $dateComparison;
        });
        


        $users = array_slice($arrayUsers, $offset, $perPage);


        if (!empty($s)) {
            $searchTerm = $s . "%";

            try {
                $users = User::findLike([
                    'first_name' => $searchTerm,
                    'last_name' => $searchTerm,
                    'email' => $searchTerm
                ]);
            } catch (ModelNotFoundException $notFound) {
                $users = [];
            }
        }

        render_view('requests', [
            "users" => $users,
            'selected' => 'requests',
            'currentPage' => $page,
            'totalPages' => $totalPages,
            'order' => $order,
        ], 'Solicitudes');
    }
   
    /**
     * Exports application data to a CSV file and prompts a download.
     *
     * The generated CSV file includes columns for applicant name, email,
     * document count, application status, submission date, and indicators
     * for various submitted documents (video essay, written essay,
     * recommendation letter, authorization letter, transcript, and photo).
     *
     * The CSV is stored temporarily and served for download, then deleted.
     *
     * @return void
     */

        public static function downloadCsvApplications() 
        {
            $users = Application::allWith('users', 'user_id', ['status'=>'status']);
        
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="solicitudes.csv"');
        
            $fp = __DIR__."/../../storage/private/solicitudes.csv";
        
            $columns = ['Nombre','Correo','Documentos Subidos', 'Estado de la solicitud', 'Fecha Subido', 'Video Ensayo',
                        'Ensayo Escrito', 'Carta de Recomendación','Certificación Estudiantil','Carta de Autorización', 'Transcripción de créditos', 'Foto'];
        
            file_put_contents($fp, implode(',', $columns) . "\n", FILE_APPEND);
        
            $statusParsing = [
                'active' => 'Activo',
                'disabled' => 'Desactivado'
            ];
        
            foreach ($users as $user) 
            {
                $documentCount = $user->documentCount();
        
                $row = [
                    $user->first_name.' '.$user->last_name,
                    $user->email,
                    $documentCount, 
                    $statusParsing[$user->status]??$user->status,
                    get_date_spanish($user->created_at),
                    $user->url_video_essay? 'X':' ',
                    $user->url_written_essay? 'X':' ',
                    $user->url_recommendation_letter? 'X':' ',
                    $user->url_written_application? 'X':' ',
                    $user->url_authorization_letter? 'X':' ',
                    $user->url_transcript? 'X':' ',
                    $user->url_picture? 'X':' ',
                ];

                file_put_contents($fp, implode(',', $row) . "\n", FILE_APPEND);
            }
            
            readfile($fp);
            unlink($fp);
            exit;
        }
}

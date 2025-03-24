<?php
require_once 'Controller.php';
require_once 'app/models/Audit.php';


class AuditController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function index()
    {
        $audits = Audit::all();
        render_view('audit', ['audits' => $audits], 'Auditoría');

    }

    public static function download()
    {
        // set locale to spanish
        setlocale(LC_ALL, 'es_ES');


        $audits = Audit::all();
        $csv = 'user_id,action,summary,made_on' . PHP_EOL;
        foreach ($audits as $audit) {
            $csv .= $audit->user_id . ',' . $audit->action . ',' . iconv('UTF-8', 'ISO-8859-1//TRANSLIT', $audit->summary) . ',' . $audit->made_on . PHP_EOL;
        }
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="audits.csv"');
        echo $csv;
        exit;
    }

    // define your other methods here
}

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

    // define your other methods here
}

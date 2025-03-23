<?php
require_once 'Controller.php';

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
        render_view('audit', [], 'Auditoría');

    }

    // define your other methods here
}

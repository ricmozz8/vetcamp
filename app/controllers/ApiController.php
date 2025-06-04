<?php
require_once 'Controller.php';
require_once 'database/connector.php';
require_once 'app/models/Session.php';
require_once 'app/models/LimitDate.php';
require_once 'app/models/Application.php';
require_once 'storage/Storage.php';

class ApiController extends Controller
{
    private static function connect()
    {
        DB::connect(CONFIG['database'], CONFIG['database']['user'], CONFIG['database']['pass']);
    }

    public static function requestStats()
    {
        self::connect();
        $sql = "SELECT status, COUNT(*) AS total FROM applications GROUP BY status";
        $results = DB::execute_and_fetch($sql, []);

        $stats = [];
        $total = 0;
        foreach ($results as $row) {
            $stats[$row['status']] = (int)$row['total'];
            $total += (int)$row['total'];
        }

        header('Content-Type: application/json');
        echo json_encode(['total' => $total, 'by_status' => $stats]);
        exit;
    }

    public static function serverStatus()
    {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'ok']);
        exit;
    }
    public static function userStats()
    {
        self::connect();
        $sql = "SELECT status, COUNT(*) AS total FROM users WHERE type = 'user' GROUP BY status";
        $results = DB::execute_and_fetch($sql, []);

        $stats = [];
        $total = 0;
        foreach ($results as $row) {
            $stats[$row['status']] = (int)$row['total'];
            $total += (int)$row['total'];
        }

        header('Content-Type: application/json');
        echo json_encode(['total' => $total, 'by_status' => $stats]);
        exit;
    }

    public static function dates()
    {
        self::connect();

        try {
            $limit = LimitDate::find(1);
        } catch (ModelNotFoundException $e) {
            $limit = LimitDate::create([
                'id_date' => 1,
                'start_date' => date('Y-m-d'),
                'end_date' => date('Y-m-d'),
            ]);
        }

        $sessions = Session::all();
        $session_data = [];
        foreach ($sessions as $session) {
            $session_data[] = [
                'id' => (int)$session->session_id,
                'title' => $session->title,
                'start_date' => $session->start_date,
                'end_date' => $session->end_date,
            ];
        }

        $can_request = time() <= strtotime($limit->end_date);

        header('Content-Type: application/json');
        echo json_encode([
            'limit_dates' => [
                'start_date' => $limit->start_date,
                'end_date' => $limit->end_date,
            ],
            'can_request' => $can_request,
            'sessions' => $session_data,
        ]);
        exit;
    }
}

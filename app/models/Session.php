<?php
require_once 'Model.php';

class Session extends Model{

   // define your methods here
    protected static $primary_key = 'id_session';
    protected static $table = 'sessions';

    private $months = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];

    public function get_formatted_date(string $type = "start_date"){
        if ($type === 'end_date') {
            // get day month and year separated
            $dateObject = new DateTime($this->attributes['end_date']);

        } else {
            $dateObject = new DateTime($this->attributes['start_date']);
        }

        $day = $dateObject->format('d');
        $month = $dateObject->format('m');
        $year = $dateObject->format('Y');

        return $day . ' de ' . $this->months[$month] . ' de ' . $year;
    }
}
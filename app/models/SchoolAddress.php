<?php
require_once 'Model.php';

class SchoolAddress extends Model
{

    // define your methods here
    protected static $table = 'school_address';

    protected $typeParsings = [
        'public' => 'Pública',
        'private' => 'Privada',
        'homeschooled' => 'Homeschooled'
    ];

    /**
     * Returns the full postal address as a string.
     * 
     * The format used is:
     * "aline1, aline2 city zip_code"
     * 
     * @return string The full postal address.
     */
    public function build()
    {
        return  $this->street .
            ' ' . $this->city .
            ' ' . $this->zip_code . ' (' . $this->typeParsings[$this->school_type] . ')';

    }
}

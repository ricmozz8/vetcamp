<?php
require_once 'Model.php';

class PostalAddress extends Model
{

    // define your methods here
    protected static $table = 'postal_address';


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
        return  $this->aline1 .
            ', ' . $this->aline2 .
            ' ' . $this->city .
            ' ' . $this->zip_code ;
    }
}

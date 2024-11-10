<?php
require_once 'Model.php';

class Application extends Model{

    protected static $primary_key = 'application_id'; // Primary key
    protected static $table = 'applications'; // Table name
}
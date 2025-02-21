<?php 
require_once 'Model.php';

class Tracking extends Model{

    protected static $table = 'evaluated_by'; // Table name
    protected static $primary_key = 'application_id';
}
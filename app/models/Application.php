<?php
require_once 'Model.php';

class Application extends Model{

    // define your methods here

    protected static $primary_key = 'application_id';
    protected static $table = 'applications';
}
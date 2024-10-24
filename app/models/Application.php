<?php
require_once 'Model.php';

class Application extends Model{

    // define your methods here

    protected static $primary_key = 'id_solicitud';
    protected static $table = 'solicitud';
}
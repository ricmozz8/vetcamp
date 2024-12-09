<?php
require_once 'Model.php';

class Message extends Model{

    // define your methods here
    protected static $primary_key = 'id_message';
    protected static $table = 'messages';
}

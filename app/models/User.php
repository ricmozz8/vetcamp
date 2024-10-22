<?php
require_once 'Model.php';

class User extends Model{

    // define your methods here
    // protected static $table = 'usuarios'; // change here the table name
    protected static $hidden = ['contrasena', 'estado', 'id_usuario'];
    protected static $primary_key = 'id_usuario';


}
<?php

require_once __DIR__ . '/../../database/connector.php';

class Model
{
    static protected $table;


    /**
     * Initializes the model by setting the table name to be the lowercase version of
     * the class name with an 's' appended to the end.
     *
     * For example, if the class name is "User", the table name will be set to "users".
     *
     * @return void
     */
    public static function init(){
        if (empty(self::$table)) {  
            self::$table = strtolower(static::class) . 's';
        }
    }


    /**
     * Returns all records from the associated table.
     *
     * @return array An array of associative arrays, where each key is the name of a
     *               column, and the value is the value of that column in the
     *               database.
     */
    public static function all() {

        self::init();

        DB::connect();
        return DB::select(self::$table, '*');
    }
}

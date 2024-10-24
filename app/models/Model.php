<?php

require_once __DIR__ . '/../../database/connector.php';


class Model
{
    protected static $table;
    protected $attributes = [];
    public $values = [];
    private static $initialized = false;

    protected static $primary_key = 'id';
    protected static $hidden = []; // attributes that should not be serialized

    /**
     * Sets the table name for the model based on the class name.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected function __construct(array $attributes, array $sanitized){
        self::init();
        self::set_attributes($attributes);
        $this->values = $sanitized;
    }


    /**
     * Initializes the model by connecting to the database and setting the model attributes.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    private static function init()
    {
        DB::connect(CONFIG['database'], CONFIG['database']['user'], CONFIG['database']['pass']);

        if (self::$initialized) {
            return;
        }

        if (empty(static::$table)){
            static::$table = strtolower(static::class) . 's';
        }

        self::$initialized = true;
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

        $model_list = [];
        foreach(DB::select(static::$table, '*') as $model) {
            $model_list[] = new static($model, self::sanitize($model));
        }

        return $model_list;
    }



    /**
     * Returns all records from the associated table where the specified column
     * matches the given value.
     *
     * @param string|int $id The value to match in the database.
     * @param string $column The column to use in the WHERE clause.
     *
     * @return array An array of associative arrays, where each key is the name of a
     *               column, and the value is the value of that column in the
     *               database.
     */
    public static function findAll(int $id, string $column = null) : Model {
        self::init();

        $data = DB::whereAll(static::$table, $column ?? static::$primary_key, $id);

        return new static($data, self::sanitize($data));

    }

    /**
     * Returns the record from the associated table where the specified column
     * matches the given value.
     *
     * @param string|int $id The value to match in the specified column.
     * @param string $column The column to use for matching the value. Defaults to 'id'.
     *
     * @return Model An instance of the model class.
     */
    public static function find(int $id, string $column = null) : Model {
        self::init();

        $data = DB::where(static::$table, $column ?? static::$primary_key, $id);
        return new static($data, self::sanitize($data));
    }

  
    /**
     * Creates a new model and saves it to the database.
     *
     * @param array $data The data to create the model with.
     *
     * @return Model The newly created model instance.
     */
    public static function create(array $data) : Model
    {
        $newModel = new static($data, self::sanitize($data));
        $newModel->save();

        return $newModel;
        
    }

    
    /**
     * Sets the value of a model attribute.
     *
     * @param string $attribute The name of the attribute to set.
     * @param mixed $value The value to set for the attribute.
     *
     * @return bool Returns true if the attribute was successfully set, otherwise false.
     */
    public function set($attribute, $value) : bool {
        if (!array_key_exists($attribute, $this->attributes)) {
            return false;
        }

        $this->attributes[$attribute] = $value;
        $this->values[$attribute] = $value;

        return true;
    }


    /**
     * Updates the model attributes with the provided data array.
     *
     * Iterates over the given data array and updates the model's attributes
     * if the keys exist in the current attributes. The method uses the `set`
     * function to update each attribute.
     *
     * @param array $data An associative array where keys are attribute names
     *                    and values are the new values for those attributes.
     *
     * @return bool Returns true after updating the attributes.
     */
    public function update(array $data) : bool {

        foreach ($data as $key => $value) {
            if(!array_key_exists($key, $this->attributes)) {
                continue;
            }

            $this->set($key, $value);
        }

        $this->save();
    
        return true;
        
    }


    /**
     * Inserts a new record into the associated table using the current model attributes.
     *
     * @return bool Returns true if the record was successfully inserted, otherwise false.
     */
    public function save() : bool
    {   
        return DB::update(static::$table, $this->values, static::$primary_key, $this->attributes[static::$primary_key]);
    }

    /**
     * Sets the model attributes from the given associative array.
     *
     * @param array $data The associative array where the keys are the column
     *                    names and the values are the values of the columns.
     *
     * @return void
     */

    private function set_attributes(array $data) {
        foreach ($data as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }



    /**
     * Removes specified attributes from the given data array.
     *
     * This method iterates over the `hidden` attributes of the model
     * and unsets them from the provided data array, effectively
     * sanitizing the data by excluding sensitive or unwanted information.
     *
     * @param array $data The associative array of data to be sanitized.
     *
     * @return array The sanitized data array with hidden attributes removed.
     */
    private static function sanitize(array $data) {
        foreach(static::$hidden as $to_hide) {
            unset($data[$to_hide]);
        }
        return $data;
    }



}

<?php

require_once __DIR__ . '/../../database/connector.php';


class Model
{
    protected static $table; // The name of the table associated with the model
    protected $attributes = []; // The attributes of the model
    public $values = []; // The sanitized values of the model
    private static $initialized = false; // A flag indicating whether the model has been initialized
    protected static $primary_key = 'id'; // The primary key of the model
    protected static $hidden = [];  // An array of attributes that should not be serialized

    /**
     * Sets the table name for the model based on the class name.
     *
     * This method is called when a new instance of the class is created.
     *
     * @return void
     */
    protected function __construct(array $attributes, array $sanitized)
    {
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

        if (empty(static::$table)) {
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
    public static function all()
    {
        self::init();

        $model_list = [];
        foreach (DB::select(static::$table, '*') as $model) {
            $model_list[] = new static($model, self::sanitize($model));
        }

        return $model_list;
    }

    /**
     * Returns attributes by key (getter function)
     */
    public function __get($key)
    {
        return $this->attributes[$key] ?? null;
    }


    /**
     * Returns all records from the associated table where the specified column
     * matches the given value.
     *
     * @param int $id The value to match in the database.
     * @param string|null $column The column to use in the WHERE clause. If not
     *                            specified, the primary key column is used.
     *
     * @return Model An instance of the Model class containing the matching records.
     *
     * @throws ModelNotFoundException If no records are found with the specified id.
     */
    public static function findAll(int $id, string $column = null, string $table = null)
    {
        self::init();

        $data = DB::whereAll($table ?? static::$table, $column ?? static::$primary_key, $id);


        if (empty($data)) {
            throw new ModelNotFoundException('There is no record with the id given:  ' . $id);
        } else {
            $models = [];
            foreach ($data as $result) {
                $models[] = new static($result, self::sanitize($result));
            }

            return $models;
        }
    }


    /**
     * Returns a single record from the associated table where the specified
     * column matches the given value.
     *
     * @param int $id The value to match in the database.
     * @param string $column The column to use in the WHERE clause.
     *
     * @return Model The model instance with the matching record.
     *
     * @throws ModelNotFoundException If the record is not found.
     */
    public static function find(int $id, string $column = null, string $table = null): Model
    {
        self::init();
        $data = DB::where($table ?? static::$table, $column ?? static::$primary_key, $id);

        if (empty($data)) {
            throw new ModelNotFoundException('There is no record with the id given: ' . $id);
        } else {
            return new static($data, self::sanitize($data));
        }

    }


    /**
     * Finds a record in the associated table with the given data
     *
     * @param array $data An associative array with the column(s) to search as
     *                    the key(s) and the value(s) as the value(s) to match
     *
     * @return array|Model The model or models with the matching record.
     *
     * @throws ModelNotFoundException If the record is not found.
     */
    public static function findBy(array $data)
    {
        self::init();

        $data = DB::whereColumns(static::$table, $data);

        if (empty($data)) {
            throw new ModelNotFoundException('There is no record with the data given');
        }

        return new static($data, self::sanitize($data));
    }


    /**
     * Finds a record in the associated table where any of the columns match
     * the given patterns.
     *
     * @param array $data An associative array with the column(s) to search as
     *                    the key(s) and the value(s) as the pattern(s) to match
     *
     * @return Model The model instance with the matching record.
     *
     * @throws ModelNotFoundException If the record is not found.
     */
    public static function findLike(array $data): array
    {
        self::init();


        $results = DB::like(static::$table, $data);

        if (empty($results)) {
            throw new ModelNotFoundException('There is no record matching the given data.');
        }

        $models = [];
        foreach ($results as $result) {
            $models[] = new static($result, self::sanitize($result));
        }

        return $models;
    }


    /**
     * Returns all records from the associated table joined with a specified
     * table where the specified column matches the given value.
     *
     * @param string $table The table to join with.
     * @param string $column The column to use in the WHERE clause.
     * @param array $renames An associative array where keys are column names and
     *                      values are the new names for those columns.
     *
     * @return array The results of the join query as an array of associative arrays.
     *
     * @throws ModelNotFoundException If no records are found with the specified id.
     */
    public static function conjoined(string $table)
    {
        $results = DB::naturalJoin(static::$table, $table);

        if (empty($results)) {
            throw new ModelNotFoundException('There is no record matching the given data.');
        } else {
            foreach ($results as $result) {
                $models[] = new static($result, self::sanitize($result));
            }
        }

        return $models;
    }

    /**
     * Gets all records that matches a set of conditions
     * @param array $data An associative array of columns and desired value
     * @return array An array of models that matches the passed conditions
     * @throws ModelNotFoundException if no comments were found
     */
    public static function findAllBy(array $data): array
    {
        self::init();

        $results = DB::whereAllColumns(static::$table, $data);

        if (empty($results)) {
            throw new ModelNotFoundException('There is no record matching the given data.');
        }

        $models = [];
        foreach ($results as $result) {
            $models[] = new static($result, self::sanitize($result));
        }

        return $models;
    }


    /**
     * Creates a new model and stores it to the database.
     *
     * @param array $data The data to create the model with.
     *
     * @return Model The newly created model instance.
     */
    public static function create(array $data)
    {
        $newModel = new static($data, self::sanitize($data));

        $stored = $newModel->store();

        if ($stored) {
            return $newModel;
        } else {
            throw new Error('Error creating model');
        }

    }

    
    /**
     * Returns all records from the associated table joined with a specified
     * table.
     *
     * @param string $table The table to join with.
     * @param string $primary_key The primary key of the table to join with.
     *
     * @return array An array of models with the matching records.
     */
    public static function allWith(string $table, string $column, array $renames = []) {
        self::init();

        $result = DB::join(static::$table, $table, $column, $renames);
        $models = [];

        $models = [];

        foreach ($result as $data) {
            // can't return a specific static model since the result is a model combination
            $models[] = new static($data, self::sanitize($data));
        }


        return $models;

    }

    /**
     * Returns a single record from the associated table joined with a
     * specified table where the specified column matches the given value.
     *
     * @param string $table The table to join with.
     * @param string $primary_key The primary key of the table to join with.
     * @param string $column The column to use in the WHERE clause.
     * @param string $identifier The value to match in the WHERE clause.
     *
     * @return Model The model instance with the matching record.
     */
    public static function with(string $table, string $primary_key, string $column, string $identifier) {
        self::init();
        $result = DB::singleJoin(static::$table, $table, static::$primary_key, $primary_key, $column, $identifier);

        return new Model($result, self::sanitize($result));
    }

    /**
     * Sets the value of a model attribute.
     *
     * @param string $attribute The name of the attribute to set.
     * @param mixed $value The value to set for the attribute.
     *
     * @return bool Returns true if the attribute was successfully set, otherwise false.
     */
    public function set($attribute, $value): bool
    {
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
    public function update(array $data): bool
    {

        foreach ($data as $key => $value) {
            if (!array_key_exists($key, $this->attributes)) {
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
    public function save(): bool
    {
        return DB::update(static::$table, $this->values, static::$primary_key, $this->attributes[static::$primary_key]);
    }


    /**
     * Creates a new record in the associated table using the current model attributes.
     *
     * @return bool Returns true if the record was successfully inserted, otherwise false.
     */
    public function store(): bool
    {
        return DB::insert(static::$table, $this->attributes);
    }

    /**
     * Deletes the current record from the associated table.
     *
     * This method removes the record identified by the primary key from the database.
     * It initializes the model if necessary before performing the delete operation.
     *
     * @return bool Returns true if the record was successfully deleted, otherwise false.
     */
    public function delete()
    {
        return DB::remove(static::$table, static::$primary_key, $this->attributes[static::$primary_key]);
    }




    /**
     * Checks if a record exists in the associated table with the given data.
     *
     * @param array $with An associative array with the column(s) to search as
     *                    the key(s) and the value(s) as the value(s) to match
     *
     * @return bool Returns true if the record exists, otherwise false.
     */
    public static function exists(array $with): bool
    {
        try {
            self::findBy($with);
        } catch (ModelNotFoundException $e) {
            return false;
        }
        return true;
    }


    /**
     * Sets the model attributes from the given associative array.
     *
     * @param array $data The associative array where the keys are the column
     *                    names and the values are the values of the columns.
     *
     * @return void
     */

    private function set_attributes(array $data)
    {
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
    private static function sanitize(array $data)
    {
        foreach (static::$hidden as $to_hide) {
            unset($data[$to_hide]);
        }
        return $data;
    }

    /**
     * Counts the number of records in the associated table.
     *
     * This method initializes the model if necessary before performing the count
     * operation.
     *
     * @return int The number of records in the associated table.
     */
    public static function count(): int
    {
        self::init();
        return DB::count(static::$table);
    }

    public static function countwithCondition(string $aColumn, $aValue, string $aColumnCondition, $aValueCondition): int
    {
        self::init();
        $data = DB::countwithCondition(static::$table, $aColumn, $aValue, $aColumnCondition, $aValueCondition);

        if (empty($data)) {
            throw new ModelNotFoundException('There is no record with the id given: ');
        } else {
            return $data;
        }

    }


    /**
     * Executes a raw SQL query and returns the result as an instance of the
     * current model.
     *
     * @param string $query The raw SQL query to execute.
     * @param string $mode The mode of the fetch operation. Can be either 'all'
     *                     or 'num'. If 'all', the result will be fetched as
     *                     an associative array. If 'num', the result will be
     *                     fetched as a numerical array.
     *
     * @return Model An instance of the current model containing the result of
     *               the query.
     */
    public static function raw(string $query, string $mode){

        if ($mode == 'all') 
            $param =  PDO::FETCH_ASSOC;
        else
            $param =  PDO::FETCH_NUM;
     

        self::init();
        $result = DB::execute_and_fetch($query, []);
        return new static($result, $result);
    }
    


}

<?php


final class DB
{
    private static $database; /* The PDO instance for the database connection.*/


    private static $database_name; /* The name of the database.*/
    

    /**
     * Connects to the database using the environment variables, or the default values
     * if they are not set.
     *
     *
     * If the connection fails, an Error exception is thrown.
     *
     * @throws Error if there is an error connecting to the database.
     */
    public static function connect($connection, $user = 'root', $password = '')
    {

        $dsn = 'mysql:' . http_build_query($connection, '', ';');

        try {

            self::$database = new PDO($dsn, $user, $password, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);

            // defining class properties
            
            self::$database_name = $connection['dbname'];


        } catch (PDOException $e) {
            throw new Error('Failed to connect to the database: ' . $e->getMessage());
        }
    }


    /**
     * Execute a SELECT query on the database.
     *
     * This method will prepare and execute a SELECT query on the database. The
     * results of the query will be returned as an array of associative arrays,
     * where each key is the name of the column, and the value is the value of the
     * column.
     *
     * @param string $column The column(s) to select. The default is to select all
     *                       columns.
     *
     * @return array The results of the query as an array of associative arrays.
     */
    public static function select(string $table, string $column = '*'): array
    {

        $sql = 'SELECT ' . $column . ' FROM ' . self::$database_name . '.' . $table;
        $statement = self::$database->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }



    /**
     * Execute a SELECT query with a WHERE clause on the database.
     *
     * This method will prepare and execute a SELECT query with a WHERE clause
     * on the database. The results of the query will be returned as an array
     * of associative arrays, where each key is the name of the column, and the
     * value is the value of the column.
     *
     * @param string $table The name of the table to select from.
     * @param string $column The column(s) to select. The default is to select all
     *                       columns.
     * @param string $where The column to use in the WHERE clause.
     * @param string $equal The value to match in the WHERE clause.
     *
     * @return array The results of the query as an array of associative arrays.
     */
    public static function whereAll(string $table, string $where, string $equal, string $column = '*'): array{

        $sql = 'SELECT ' . $column . ' FROM ' . self::$database_name . '.' . $table . ' WHERE ' . $where . ' = ' . $equal;

   
        $statement = self::$database->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
    }


    /**
     * Execute a SELECT query with a WHERE clause on the database.
     *
     * This method will prepare and execute a SELECT query with a WHERE clause
     * on the database. The results of the query will be returned as an associative
     * array, where each key is the name of the column, and the value is the value
     * of the column.
     *
     * @param string $table The name of the table to select from.
     * @param string $column The column(s) to select. The default is to select all
     *                       columns.
     * @param string $where The column to use in the WHERE clause.
     * @param string $equal The value to match in the WHERE clause.
     * @param string $operator The operator to use in the WHERE clause. The default
     *                         is '='.
     *
     * @return array The results of the query as an associative array.
     */
    public static function where(string $table, string $where, string $equal, string $column = '*', string $operator = '='): array{

        $sql = 'SELECT ' . $column . ' FROM ' . self::$database_name . '.' . $table . ' WHERE ' . $where .  ' ' . $operator . ' ' . $equal;

        $statement = self::$database->prepare($sql);
        $statement->execute();
        return $statement->fetch();
    }

    /**
     * Insert a new record into the specified table.
     *
     * This method constructs and executes an SQL INSERT statement 
     * using the provided table name and data array. The keys of the 
     * data array represent the column names, and the values are the 
     * corresponding values to be inserted.
     *
     * @param string $table The name of the table to insert the data into.
     * @param array $data An associative array where keys are column names 
     *                    and values are the values to be inserted.
     * 
     * @return bool Returns true if the record was successfully inserted, 
     *              otherwise false.
     */
    public static function insert(string $table, array $data): bool
    {
        // Prepare the SQL statement
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

        try {
            $stmt = self::$database->prepare($sql);

            // Bind the values to the placeholders
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            // Execute the statement
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception (you can log it or display a message)
            error_log($e->getMessage());
            return false;
        }
    }


    /**
     * Update a record in the specified table.
     *
     * This method constructs and executes an SQL UPDATE statement using the
     * provided table name, data array, column, and value. The keys of the data
     * array represent the column names, and the values are the values to be
     * updated.
     *
     * @param string $table The name of the table to update the record in.
     * @param array $data An associative array where keys are column names
     *                    and values are the values to be updated.
     * @param string $where The column to use in the WHERE clause.
     * @param string $equal The value to match in the WHERE clause.
     *
     * @return bool Returns true if the record was successfully updated,
     *              otherwise false.
     */
    public static function update(string $table, array $data, string $where, string $equal): bool
    {
        // sql be like UPDATE table SET column1 = ?, column2 = ? WHERE column3 = ?

        // Prepare the SQL statement
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        $sql = "UPDATE $table SET $columns = $placeholders WHERE $where = $equal";

        dd($sql);

        try {
            $stmt = self::$database->prepare($sql);

            // Bind the values to the placeholders
            foreach ($data as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }

            // Execute the statement
            return $stmt->execute();
        } catch (PDOException $e) {
            // Handle the exception (you can log it or display a message)
            error_log($e->getMessage());
            return false;
        }
    }


    /**
     * Delete a record from the specified table.
     *
     * This method constructs and executes an SQL DELETE statement using the 
     * provided table name, column, and value. It deletes the record where 
     * the specified column matches the given value.
     *
     * @param string $table The name of the table to delete the record from.
     * @param string $where The column name to use in the WHERE clause.
     * @param string $equal The value to match for the specified column in the WHERE clause.
     *
     * @return bool Returns true if a record was successfully deleted, otherwise false.
     */
    public static function remove(string $table, string $where, string $equal): bool
    {

        $sql = 'DELETE FROM ' . $table . ' WHERE ' . $where . ' = ' . $equal;
        $statement = self::$database->prepare($sql);
        $statement->execute();
        return $statement->rowCount() > 0;
    }


    /**
     * Get all columns from a table.
     *
     * This method constructs and executes an SQL query that returns all columns
     * from the specified table.
     *
     * @param string $table The name of the table to get the columns from.
     *
     * @return array An array of associative arrays, where each key is the name of a
     *               column, and the value is an associative array containing the
     *               details of the column.
     */
    public static function get_columns(string $table): array
    {
        $sql = 'SHOW COLUMNS FROM ' . $table;
        // dd($sql);
        $statement = self::$database->prepare($sql);

        $statement->execute();
        return array_column($statement->fetchAll(PDO::FETCH_ASSOC), 'Field');
    }


    /**
     * Gets the PDO instance for the database connection.
     * 
     * @return PDO The database connection.
     */
    public static function getDatabase(): PDO
    {
        return self::$database;
    }
}

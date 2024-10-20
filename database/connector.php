<?php


require __DIR__ . '../../bootstrap/environment.php';
    // loading the environment variables

;


final class DB
{
    private static $database; /* The PDO instance for the database connection.*/

    /**
     * Connects to the database using the environment variables, or the default values
     * if they are not set.
     *
     * The default values are:
     * - DB_HOST: 127.0.0.1
     * - DB_PORT: 3306
     * - DB_NAME: vetcampdb
     * - DB_USER: root
     * - DB_PASS: root
     *
     * If the connection fails, an Error exception is thrown.
     *
     * @throws Error if there is an error connecting to the database.
     */
    public static function connect()
    {

        define('DB_HOST', getenv('DB_HOST') ?? '127.0.0.1');
        define('DB_PORT', getenv('DB_PORT') ?? '3306');
        define('DB_NAME', getenv('DB_NAME') ?? 'vetcampdb');
        define('DB_USER', getenv('DB_USERNAME') ?? 'root');
        define('DB_PASS', getenv('DB_PASSWORD') ?? 'root'); // change your pass here

        try {

            self::$database = new PDO("mysql:host=127.0.0.1;port=3306;dbname=vetcampdb;",'root',
                'root'
            );

            // Set the PDO error mode to exception
            self::$database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

        $sql = 'SELECT ' . $column . ' FROM ' . DB_NAME . '.' . $table;
        $statement = self::$database->prepare($sql);
        $statement->execute();
        return $statement->fetchAll(PDO::FETCH_ASSOC);
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
        $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', array_keys($data)) . ') VALUES (' . implode(', ', array_fill(0, count($data), '?')) . ')';
        $statement = self::$database->prepare($sql);
        $statement->execute(array_values($data));

        return $statement->rowCount() > 0;
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
        $sql = 'UPDATE ' . $table . ' SET ' . implode(', ', array_map(function ($key) {
            return $key . ' = ?';
        }, array_keys($data))) . ' WHERE ' . $where . ' = ' . $equal;
        $statement = self::$database->prepare($sql);
        $statement->execute(array_values($data));
        return $statement->rowCount() > 0;
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
     * Gets the PDO instance for the database connection.
     * 
     * @return PDO The database connection.
     */
    public static function getDatabase(): PDO
    {
        return self::$database;
    }
}

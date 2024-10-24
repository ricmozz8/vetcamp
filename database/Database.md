# DB Class

## Overview
The `DB` class provides a set of static methods for interacting with a database using PDO. It allows for executing various SQL queries, including SELECT, INSERT, UPDATE, DELETE, and more.

## Class Properties

- **private static $database**: The PDO instance for the database connection.
- **private static $database_name**: The name of the database.

## Methods

### `static connect($connection, $user = 'root', $password = '')`

Connects to the database using the provided connection parameters.

- **Parameters**:
  - `array $connection`: An associative array containing connection parameters (e.g., host, dbname).
  - `string $user`: The username for the database connection (default is 'root').
  - `string $password`: The password for the database connection (default is an empty string).

- **Throws**: `Error` if there is an error connecting to the database.

- **Returns**: void

### `static select(string $table, string $column = '*'): array`

Executes a SELECT query on the database.

- **Parameters**:
  - `string $table`: The name of the table to select from.
  - `string $column`: The column(s) to select (default is '*').

- **Returns**: `array` - The results of the query as an array of associative arrays.

### `static whereAll(string $table, string $where, string $equal, string $column = '*'): array`

Executes a SELECT query with a WHERE clause on the database.

- **Parameters**:
  - `string $table`: The name of the table to select from.
  - `string $column`: The column(s) to select (default is '*').
  - `string $where`: The column to use in the WHERE clause.
  - `string $equal`: The value to match in the WHERE clause.

- **Returns**: `array` - The results of the query as an array of associative arrays.

### `static where(string $table, string $where, string $equal, string $column = '*', string $operator = '='): array`

Executes a SELECT query with a WHERE clause on the database.

- **Parameters**:
  - `string $table`: The name of the table to select from.
  - `string $column`: The column(s) to select (default is '*').
  - `string $where`: The column to use in the WHERE clause.
  - `string $equal`: The value to match in the WHERE clause.
  - `string $operator`: The operator to use in the WHERE clause (default is '=').

- **Returns**: `array` - The results of the query as an associative array.

### `static insert(string $table, array $data): bool`

Inserts a new record into the specified table.

- **Parameters**:
  - `string $table`: The name of the table to insert the data into.
  - `array $data`: An associative array where keys are column names and values are the values to be inserted.

- **Returns**: `bool` - Returns true if the record was successfully inserted, otherwise false.

### `static update(string $table, array $data, string $where, string $equal): bool`

Updates a record in the specified table.

- **Parameters**:
  - `string $table`: The name of the table to update the record in.
  - `array $data`: An associative array where keys are column names and values are the values to be updated.
  - `string $where`: The column to use in the WHERE clause.
  - `string $equal`: The value to match in the WHERE clause.

- **Returns**: `bool` - Returns true if the record was successfully updated, otherwise false.

### `static remove(string $table, string $where, string $equal): bool`

Deletes a record from the specified table.

- **Parameters**:
  - `string $table`: The name of the table to delete the record from.
  - `string $where`: The column name to use in the WHERE clause.
  - `string $equal`: The value to match for the specified column in the WHERE clause.

- **Returns**: `bool` - Returns true if a record was successfully deleted, otherwise false.

### `static get_columns(string $table): array`

Gets all columns from a table.

- **Parameters**:
  - `string $table`: The name of the table to get the columns from.

- **Returns**: `array` - An array of column names.

### `static execute(string $sql, array $data = null): bool`

Executes an SQL query and returns true if the query affected at least one row.

- **Parameters**:
  - `string $sql`: The SQL query to execute.
  - `array $data`: The
  - `array $data`: The data to bind to the query (optional).

- **Returns**: `bool` - Returns true if the query affected at least one row, otherwise false.

### `static execute_and_fetch(string $sql, array $data = null): array`

Executes an SQL query and returns the results as an array of associative arrays.

- **Parameters**:
  - `string $sql`: The SQL query to execute.
  - `array $data`: The data to bind to the query (optional).

- **Returns**: `array` - The results of the query as an array of associative arrays.

### `static getDatabase(): PDO`

Gets the PDO instance for the database connection.

- **Returns**: `PDO` - The database connection.

## Usage Example

```php
// Connect to the database
DB::connect(['host' => 'localhost', 'dbname' => 'test_db'], 'username', 'password');

// Select all records from a table
$results = DB::select('users');

// Insert a new record into a table
$inserted = DB::insert('users', ['name' => 'John Doe', 'email' => 'john@example.com']);

// Update a record in a table
$updated = DB::update('users', ['email' => 'john.doe@example.com'], 'name', 'John Doe');

// Delete a record from a table
$deleted = DB::remove('users', 'name', 'John Doe');

// Get all columns from a table
$columns = DB::get_columns('users');

// Execute a custom SQL query
$customResults = DB::execute_and_fetch('SELECT * FROM users WHERE email = ?', ['john.doe@example.com']);

# Documentation for Model Class

## Overview
The `Model` class provides an abstraction for interacting with a database table. It allows for basic CRUD (Create, Read, Update, Delete) operations and manages the attributes of the model.

## Class Properties

- **protected static $table**: The name of the database table associated with the model.
- **protected $attributes**: An associative array holding the model's attributes.
- **public $values**: An array holding the sanitized values of the model's attributes.
- **private static $initialized**: A flag indicating whether the model has been initialized.
- **protected static $primary_key**: The primary key of the model, defaulting to 'id'.
- **protected static $hidden**: An array of attributes that should not be serialized.

## Constructor

### `__construct(array $attributes, array $sanitized)`

Initializes a new instance of the model.

- **Parameters**:
  - `array $attributes`: The attributes of the model.
  - `array $sanitized`: The sanitized values of the attributes.

- **Returns**: void

## Methods

### `static init()`

Initializes the model by connecting to the database and setting the model attributes.

- **Returns**: void

### `static all()`

Returns all records from the associated table.

- **Returns**: `array` - An array of model instances.

### `static findAll(int $id, string $column = null)`

Returns all records from the associated table where the specified column matches the given value.

- **Parameters**:
  - `int $id`: The value to match in the database.
  - `string $column`: The column to use in the WHERE clause (optional).

- **Returns**: `Model` - An instance of the model class.

### `static find(int $id, string $column = null)`

Returns a single record from the associated table where the specified column matches the given value.

- **Parameters**:
  - `int $id`: The value to match in the specified column.
  - `string $column`: The column to use for matching the value (optional, defaults to 'id').

- **Returns**: `Model` - An instance of the model class.

### `static create(array $data)`

Creates a new model and saves it to the database.

- **Parameters**:
  - `array $data`: The data to create the model with.

- **Returns**: `Model` - The newly created model instance.

### `public set($attribute, $value)`

Sets the value of a model attribute.

- **Parameters**:
  - `string $attribute`: The name of the attribute to set.
  - `mixed $value`: The value to set for the attribute.

- **Returns**: `bool` - Returns true if the attribute was successfully set, otherwise false.

### `public update(array $data)`

Updates the model attributes with the provided data array.

- **Parameters**:
  - `array $data`: An associative array where keys are attribute names and values are the new values for those attributes.

- **Returns**: `bool` - Returns true after updating the attributes.

### `public save()`

Inserts a new record into the associated table using the current model attributes.

- **Returns**: `bool` - Returns true if the record was successfully inserted, otherwise false.

### `private set_attributes(array $data)`

Sets the model attributes from the given associative array.

- **Parameters**:
  - `array $data`: The associative array where the keys are the column names and the values are the values of the columns.

- **Returns**: void

### `private static sanitize(array $data)`

Removes specified attributes from the given data array.

- **Parameters**:
  - `array $data`: The associative array of data to be sanitized.

- **Returns**: `array` - The sanitized data array with hidden attributes removed.

## Usage Example

```php

class User extends Model{

    // define your methods here 
}

// Find a new User\Model instance
$userObject = User::find(1);

// Update the model
$userObject->update(['primer_nombre' => 'John D.']);
```

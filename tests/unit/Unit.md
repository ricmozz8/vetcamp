# Unit Class

## Overview
The `Unit` class serves as a superclass for unit tests that are run before code is committed to the repository. It provides various assertion methods to validate conditions in tests and a method to execute all test methods in the class.

## Methods

### `protected function assert_true(mixed $value): bool`

Asserts that the given value is true.

- **Parameters**:
  - `mixed $value`: The value to check if true.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `protected function assert_false(mixed $value): bool`

Asserts that the given value is false.

- **Parameters**:
  - `mixed $value`: The value to check if false.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `protected function assert_null(mixed $value): bool`

Asserts that the given value is null.

- **Parameters**:
  - `mixed $value`: The value to check if null.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `protected function assert_equal(mixed $value1, mixed $value2): bool`

Asserts that the given values are equal.

- **Parameters**:
  - `mixed $value1`: The first value to check.
  - `mixed $value2`: The second value to check.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `protected function assert_not_equal(mixed $value1, mixed $value2): bool`

Asserts that the given values are not equal.

- **Parameters**:
  - `mixed $value1`: The first value to check.
  - `mixed $value2`: The second value to check.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `protected function assert_type(mixed $value1, mixed $value2): bool`

Asserts that the given values are of the same type.

- **Parameters**:
  - `mixed $value1`: The first value to check.
  - `mixed $value2`: The second value to check.

- **Returns**: `bool` - True if the assertion passes, otherwise throws an `Error`.

### `public function start_test()`

Runs all the test methods in this class and prints out the results.

- **Returns**: void

- **Notes**: 
  - The method looks for all methods in the class that start with "test" and executes them.
  - It keeps track of the number of tests passed and failed, printing the results to the console.

## Usage Example

Run the command:
```bash
php craft test MyTests
```
Define a test class:

```php
class MyTests extends Unit
{
    public function testExample()
    {
        $this->assert_true(true);
    }

    public function testAnotherExample()
    {
        $this->assert_equal(1, 1);
    }
}
```

Then run the test:

```bash
php runtest
```
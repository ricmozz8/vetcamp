# Auth Class

## Overview
The `Auth` class provides a simple authentication mechanism for managing user sessions. It allows for logging in and out users, as well as checking the authentication status.

## Class Properties

- **public static $user**: Holds the currently logged-in user.

## Methods

### `static login(array $user)`

Sets the user as logged in and stores it in the session.

- **Parameters**:
  - `array $user`: The user data to be logged in.

- **Returns**: void

- **Notes**: 
  - If a user is already logged in, the method will not perform any action.
  - The session is started if it is not already active.

### `static logout()`

Unsets the user as logged in and removes it from the session.

- **Returns**: void

- **Notes**: 
  - If there is no user logged in, the method will not perform any action.
  - The session is aborted after the user is logged out.

### `static check()`

Checks if the user is logged in.

- **Returns**: `bool` - Returns true if the user is logged in, false otherwise.

## Usage Example

```php

// Find the user
$user = User::where('contrasena', '123456');

// Log in the user
Auth::login($user);

// Check if the user is logged in
if (Auth::check()) {
    echo 'User is logged in.';
}

// Log out the user
Auth::logout();

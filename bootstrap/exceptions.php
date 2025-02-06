<?php



// Define your custom exceptions here

class NotImplementedException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class ModelNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

}

class ViewNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

class DatabaseConnectionException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}


class DatabaseQueryException extends Exception
{
    private $query;
    public function __construct($message = "", $query = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message . ' with query ' . $query, $code, $previous);
    }
}

class FileNotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

// handling exceptions and adding a style
function exceptionHandler( $exception) {

    // Log the error

    ErrorLog::log(
        $exception->getMessage(),
        $exception->getFile() . ' on line ' . $exception->getLine(),
        $exception->getTraceAsString(),
    );

    $is_debug = get_config('app', 'debug');

    if ($is_debug == "false") {    
        abort(500);
    }

    // Stylize the error message
   $exception_name = get_class($exception);
   $exception_message = $exception->getMessage();
   $exception_trace = $exception->getTrace();
   $exception_file = $exception->getFile();
   $exception_line = $exception->getLine();


   // getting the file contents to show at the view

//    $exception_file_contents = file_get_contents($exception_file);

   // save only 15 lines between the error line

   render_view('crash', [
        'exception_name' => $exception_name, 
        'exception_message' => $exception_message,
        'exception_trace' => $exception_trace,
        'exception_file' => $exception_file,
        'exception_line' => $exception_line,

    ], 'Error');
}

/**
 * Handles exceptions by logging the error details and rendering a styled error view.
 *
 * @param Exception $exception The exception object to be handled.
 */

function internalServerErrorHandler($errno, $errstr, $errfile, $errline) {
    ErrorLog::log(
        $errstr . '(' . $errno . ')',
        $errfile . ' on line ' . $errline,
        '',
        'crash'
    );

    redirect('/');
}


// Set the custom error handler
set_error_handler('internalServerErrorHandler');

// Set the custom exception handler
set_exception_handler('exceptionHandler');

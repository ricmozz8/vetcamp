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

// handling exceptions and adding a style
function exceptionHandler( $exception) {
    // Stylize the error message
   $exception_name = get_class($exception);
   $exception_message = $exception->getMessage();
   $exception_trace = $exception->getTrace();
   $exception_file = $exception->getFile();
   $exception_line = $exception->getLine();

   $exception_trace_files = [];
   foreach ($exception_trace as $trace) {
       $exception_trace_files[] = $trace['file'];
   }

   // getting the file contents to show at the view

//    $exception_file_contents = file_get_contents($exception_file);

   // save only 15 lines between the error line

   render_view('crash', [
        'exception_name' => $exception_name, 
        'exception_message' => $exception_message,
        'exception_trace' => $exception_trace_files,
        'exception_file' => $exception_file,
        'exception_line' => $exception_line,

    ], 'Error');
}

// Set the custom exception handler
set_exception_handler('exceptionHandler');

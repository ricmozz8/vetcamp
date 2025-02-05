<?php

define('ERROR_LOG_FILE', 'error_log.txt');
define('ERROR_LOG_PATH', 'storage/private/');
class ErrorLog{

    private function __construct() {} // Avoid instantiation


    /**
     * Log an error message
     * 
     * @param string $error The error message
     * @param string $file The file where the error occurred
     * @param string $file_trace The stack trace of the error
     * 
     * @return void
     */
    public static function log($error, $file, $file_trace, $type = 'error') {

        $label = '[' . strtoupper($type) . ']';

        $date = date("Y-m-d H:i:s");
        $log = $label . '[' . $date . '] ' . " - " . $error . " - " . $file . " - " . $file_trace . "\n\n";

        self::write($log);
    }

    /**
     * Get all the error logs
     * 
     * @return string The error logs
     */
    public static function all() {
        if (!file_exists(ERROR_LOG_PATH . ERROR_LOG_FILE)) {
            touch(ERROR_LOG_PATH . ERROR_LOG_FILE);
        }
        self::log('Dev log was created successfully ', 'error_log.txt', '', 'info');
        return file_get_contents(ERROR_LOG_PATH . ERROR_LOG_FILE);
    }



    /**
     * Write the log message to the file
     * 
     * @param string $log The log message
     */
    private static function write($log) {

        // Open the file in append mode
        $file = fopen(ERROR_LOG_PATH . ERROR_LOG_FILE, 'a');

        // Write the log message to the file
        fwrite($file, $log);

        // Close the file
        fclose($file);
    }



    
}
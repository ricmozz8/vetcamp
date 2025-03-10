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

        if (!file_exists(ERROR_LOG_PATH)) {
            mkdir(ERROR_LOG_PATH, 0777, true);
        }


        $date = date("Y-m-d H:i:s");
        $log = strtoupper($type)  . ' | ' . $date . ' | ' . $error . " | " . $file . " | " . $file_trace . "\n\n";

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
            self::log('Error log was created successfully ', 'error_log.txt', '', 'info');
        }
        
        return file_get_contents(ERROR_LOG_PATH . ERROR_LOG_FILE);
    }



    /**
     * Write the log message to the file
     * 
     * @param string $log The log message
     */
    private static function write($log) {

        if(!file_exists(ERROR_LOG_PATH . ERROR_LOG_FILE)) {
            touch(ERROR_LOG_PATH . ERROR_LOG_FILE);
        }
        // Write the log message to the file
        file_put_contents(ERROR_LOG_PATH . ERROR_LOG_FILE, $log, FILE_APPEND);
    }

    public static function clear() {
        if (file_exists(ERROR_LOG_PATH . ERROR_LOG_FILE)) {
            unlink(ERROR_LOG_PATH . ERROR_LOG_FILE);
        }
    }

    /**
     * AsArray
     * This method will return each error log as an associative array with the keys being:
     * - type
     * - date
     * - error
     * - file
     * - trace
     * 
     * @return array
     */
    public static function asArray() {
        $logs = self::all();
        $logEntries = explode("\n\n", trim($logs));
        $errorArray = [];

        foreach ($logEntries as $entry) {
            if (empty($entry)) {
                continue;
            }

            $entry = rtrim($entry, ' |');
            
            
            $matches = explode(' | ', trim($entry));

            
            if ($matches) {
                $errorArray[] = [
                    'type' => strtolower($matches[0]),
                    'date' => $matches[1] ?? null,
                    'error' => $matches[2] ?? null,
                    'file' => $matches[3] ?? null,
                    'trace' => $matches[4] ?? null
                ];
            }
        }

        return $errorArray;

        
    }





    
}
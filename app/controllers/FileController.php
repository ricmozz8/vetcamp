<?php

require_once 'Controller.php';

class FileController extends Controller
{
    /**
     * Outputs a PDF file from the specified disk and path.
     *
     * If the file does not exist or is not readable, a 404 error is returned.
     *
     * @param string $disk The name of the disk to retrieve the file from.
     * @param string $path The path to the file to retrieve.
     */
    public static function getFile($disk, $path)
    {
        $file_contents = Storage::get($disk, $path);
        
        if ($file_contents === false) {
            // Handling the case when file is not found or not readable
            header("HTTP/1.0 404 Not Found");
            echo "File not found.";
            exit;
        } else {
            // Set headers to output a PDF file
            header("Content-Type: application/pdf");
            header("Content-Disposition: inline; filename=\"" . basename($path) . "\"");
            header("Content-Length: " . strlen($file_contents));
            echo $file_contents;
        }

        //dd($file_contents);
    }
}
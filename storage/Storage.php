<?php

/**
 * This class will handle storage of files in various locations on the Storage folder
 *
 */
class Storage
{

    private static $storage_disk;

    /**
     * Sets the name of the disk that should be used for storing and retrieving
     * files.
     *
     * @param string $disk The name of the disk to use.
     */
    public static function setDisk($disk)
    {
        self::$storage_disk = $disk;
    }

    /**
     * Returns the name of the disk that is currently in use.
     *
     * @return string The name of the disk.
     */
    public static function getDisk()
    {
        return self::$storage_disk;
    }

    /**
     * Store a file on the specified disk.
     *
     * @param string $disk The name of the disk to store the file on.
     * @param string $path The path to the file to store.
     * @param string $contents The contents of the file to store.
     */
    public static function store($disk, $path, $contents)
    {
        // path of the file
        $file_path = 'storage/' . $disk . '/' . $path;

        // check if the folder exists if not, create it

        if (!file_exists(dirname($file_path))) {
            mkdir(dirname($file_path), 0777, true);
        } elseif (file_exists($file_path)) {
            // the directory already exists, thus we replace with the current one
            unlink($file_path);
        }

        // finally, store the file

        file_put_contents($file_path, $contents);
    }

    /**
     * Retrieve a file from the specified disk.
     *
     * @param string $disk The name of the disk to retrieve the file from.
     * @param string $path The path to the file to retrieve.
     *
     * @return string The contents of the file.
     */
    public static function get($disk, $path)
    {
        self::setDisk($disk);
        $file_path = 'storage/' . $disk . '/' . $path;

        if (file_exists($file_path) && is_readable($file_path)) {
            // get the name and size
            return file_get_contents($file_path);
        } else {
            return false;
        }
    }

    /**
     * Retrieve metadata about a file from the specified disk.
     *
     * @param string $disk The name of the disk to retrieve the file from.
     * @param string $path The path to the file to retrieve.
     *
     * @return array An associative array with the following keys:
     *               - name: The name of the file.
     *               - size: The size of the file in bytes.
     *               - type: The mime type of the file.
     *               - contents: The contents of the file.
     *
     * @throws FileNotFoundException If the file is not found.
     */
    public static function get_metadata($disk, $path)
    {
        $file_path = 'storage/' . $disk . '/' . $path;
        if (file_exists($file_path)) {
            return [
                'name' => basename($file_path),
                'size' => filesize($file_path),
                'type' => mime_content_type($file_path),
                'contents' => file_get_contents($file_path)
            ];
        }
        throw new FileNotFoundException('File with path "' . $file_path . '" ' . 'not found.');
    }

    /**
     * Delete a file from the specified disk.
     *
     * @param string $disk The name of the disk to delete the file from.
     * @param string $path The path to the file to delete.
     *
     */
    public static function delete($disk, $path)
    {
        $file_path = 'storage/' . $disk . '/' . $path;
        if (!file_exists($file_path)) {
            throw new FileNotFoundException('File with path "' . $file_path . '" not found.');
        }

        // delete the file
        unlink($file_path);
    }


    /**
     * Checks the free disk space and renders an error view if space is below a specified threshold.
     * @param float|int $threshold the minimum bytes required for the system to run. Default is 60
     * @return void
     */
    public static function check_free($threshold = 100 * 1024 * 1024)
    {
        $free = disk_free_space(".");

        if ($free <= $threshold) {
            render_view('fatal', ['reason' => 'disk'], 'Error grave');
        }

    }
}

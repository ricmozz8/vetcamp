<?php 

define('ENV_FILE', '.env');


function load_environment(): int {
    if (!file_exists(ENV_FILE)) {
        echo "[WARNING] Environment file not found";
        return 0;
    }

    $env_line = file(ENV_FILE, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    // reading till the end of the file
    if (empty($env_line)) {
        return 0;
    }

    foreach ($env_line as $line) {

        if (empty($line)) {
            continue;
        }

        // ignoring comments
        if (strpos($line, '#') === 0) {
            continue;
        }

        if (strpos($line, '=') === false) {
            echo "[WARNING] Malformed line: $line\n";
            continue;
        }

        // splitting the line between the key and the value
        [$key, $value] = explode('=', $line);
        echo "[ADDING] $key = $value\n";

        // trimming the spaces
        $key = trim($key);
        $value = trim($value);

        // setting the environment variable
        putenv("$key=$value");
        continue;
        
    }

    return 1;

}
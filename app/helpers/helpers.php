<?php
define('ASSETS_FOLDER_ABSOLUTE', __DIR__ . 'resources/assets/');
define('ASSETS_FOLDER', 'resources/assets/');
define('VIEWS_DIR', __DIR__ . '/../../resources/views/');
define('WEB_RESOURCES_FOLDER', '/../../resources/views/');
define('CONFIG', require('bootstrap/config.php'));

define('DOCUMENTS_OK', 111);
define('DOCUMENTS_VALID', 222);
define('DOCUMENTS_NOT_VALID', 333);

/**
 * This is the helpers file, it will define some helper functions that need to be 
 * used on the entire website. Only define here GLOBAL functions.
 */

/**
 * Format a given phone number string into the format XXX-XXX-XXXX.
 *
 * @param string $phone The phone number string without any separators.
 * @return string The formatted phone number.
 */
function format_phone(string $phone): string
{
    return substr($phone, 0, 3) . '-' . substr($phone, 3, 3) . '-' . substr($phone, 6, 4);
}



/**
 * This function will return a valid path for the assets
 * folder.
 * 
 * @param string $subdirectory The subdirectory the asset is located, for example: if 
 * you want to access the favicon located at `/assets/logo/svg/icon.ico`, the correct usage is: 
 * `asset('logo/svg/icon.ico')`.
 * 
 * @param bool $relative If true, the path will be returned relative to the ASSETS_FOLDER, _true by default_.
 * 
 * @param bool $windows_path If true, the path will be returned in windows format, _false by default_.
 * 
 * @return string The valid path for the selected asset.
 */
function asset(string $subdirectory, bool $relative = true,  bool $windows_path = false): string
{

    // if the subdirectory starts with a slash
    if (substr($subdirectory, 0, 1) === '/') {
        // The ASSETS_FOLDER already contains the trailing slash (preventing assets//img...)
        $subdirectory = substr($subdirectory, 1);
    }

    // if the path is relative

    if ($relative) {
        $final_path = ASSETS_FOLDER . $subdirectory;
    } else {
        $final_path = ASSETS_FOLDER_ABSOLUTE . $subdirectory;
    }

    // if the path is not for windows os
    if (!$windows_path) {
        // replacing all backslashes with forward slashes
        $final_path = str_replace('\\', '/', $final_path);
    }

    return $final_path;  // returning the valid path

}


/**
 * This function will return a valid path for the resources/views folder. A web resource can be 
 * a css or js file.
 * 
 * @param string $subdirectory The subdirectory the web resource is located.
 * 
 * @return string The valid path for the selected web resource.
 */
function web_resource(string $subdirectory): string
{

    // if the subdirectory starts with a slash
    if (substr($subdirectory, 0, 1) === '/') {
        // The ASSETS_FOLDER already contains the trailing slash (preventing assets//img...)
        $subdirectory = substr($subdirectory, 1);
    }

    $final_path = WEB_RESOURCES_FOLDER . $subdirectory;


    return $final_path;
}


/**
 * Serves a view file.
 *
 * @param string $view The name of the view to serve. The .php extension
 *                     should be omitted.
 * @param array $data An associative array of variables to extract into the
 *                    view file's scope.
 */
function render_view(string $view, array $data = [], string $title = ''): void
{
    // serves the view file

    extract($data);
    $page_title = get_config('app', 'name', '') . ' - ' . $title;

    try {
        require VIEWS_DIR . $view . '.php';
    } catch (ParseError $e) {
        // check if the file exists
        throw new ViewNotFoundException('The view file does not exist: ' . VIEWS_DIR . $view . '.php' . PHP_EOL . $e->getMessage());
    }

    exit;
}

/**
 * Redirect to a given URL.
 *
 * The function uses the `header` function to send a Location header to the
 * client, and then exits the script.
 *
 * @param string $url The URL to redirect to.
 */
function redirect(string $url)
{
    header('Location: ' . $url);
    exit;
}

/**
 * Redirects to the referring URL if it exists, otherwise redirects to a given URL.
 *
 * @param string $ifFail The URL to redirect to if the referring URL does not exist.
 */
function redirect_back(string $ifFail = '/')
{
    header('Location: ' . $_SERVER['HTTP_REFERER'] ?? $ifFail);
}


/**
 * Removes the separators from a phone number string in the format (XXX)-XXX-XXXX
 *
 * @param string $phone The phone number string with separators.
 * @return string The phone number without separators.
 */
function deformat_phone(string $phone)
{
    // removing all the separators
    return str_replace(['(', ')', '-', ' '], '', $phone);
}


/**
 * Stores a value in the session.
 *
 * If the session is not already started, this function will start it.
 *
 * @param string $key The key to store the value with.
 * @param mixed $value The value to store.
 */
function session_store(string $key, $value)
{

    if (!isset($_SESSION)) {
        session_start();
    }

    $_SESSION[$key] = $value;
}

/**
 * Checks if the given key exists in the session.
 *
 * @param string $key The key to search for in the session.
 * @return bool True if the key exists, false otherwise.
 */
function session_has(string $key)
{
    return isset($_SESSION[$key]) ?? false;
}


/**
 * Formats a given date string into the format DD de MM de AAAA, DD de MM or DD depending on the parameters.
 *
 * @param string $date The date string in the format YYYY-MM-DD.
 * @param bool $withYear True if the year should be included in the formatted date.
 * @param bool $withMonth True if the month should be included in the formatted date.
 * @return string The formatted date string.
 */
function get_date_spanish($date, $withYear = true, $withMonth = true)
{
    $months = [
        '01' => 'Enero',
        '02' => 'Febrero',
        '03' => 'Marzo',
        '04' => 'Abril',
        '05' => 'Mayo',
        '06' => 'Junio',
        '07' => 'Julio',
        '08' => 'Agosto',
        '09' => 'Septiembre',
        '10' => 'Octubre',
        '11' => 'Noviembre',
        '12' => 'Diciembre'
    ];

    $day = date('d', strtotime($date));

    if (!$withMonth) {
        return $day;
    }

    $month = date('m', strtotime($date));

    if (!$withYear) {
        return $day . ' de ' . $months[$month];
    }

    $year = date('Y', strtotime($date));

    return $day . ' de ' . $months[$month] . ' de ' . $year;
}



/**
 * Encloses a string within single quotes.
 *
 * If the input is a string, it will be enclosed within single quotes,
 * otherwise, the input is returned unchanged.
 *
 * @param mixed $string The value to quote.
 * @return mixed The quoted string if the input is a string, otherwise the original input.
 */
function quote($string)
{
    if (gettype($string) !== 'string') {
        return $string;
    }
    return '\'' . $string . '\'';
}

/**
 * Checks if the given key exists in the superglobal $_COOKIE array.
 *
 * @param string $key The key to search for in the $_COOKIE array.
 * @return bool True if the key exists, false otherwise.
 */
function cookie_exists(string $key)
{
    return isset($_COOKIE[$key]) ?? false;
}


/**
 * Retrieves the value of a cookie by its key.
 *
 * Checks if the cookie exists using the `cookie_exists` function.
 * Returns the cookie value if it exists, otherwise returns null.
 *
 * @param string $key The key of the cookie to retrieve.
 * @return mixed The value of the cookie if it exists, null otherwise.
 */
function get_cookie(string $key)
{
    if (!cookie_exists($key)) {
        return null;
    }
    return $_COOKIE[$key];
}


function session_get(string $key)
{
    if (!session_has($key)) {
        return null;
    }
    return $_SESSION[$key];
}

/**
 * Dumps the given variables and ends the script.
 *
 * This function is useful for debugging purposes. It prints the contents
 * of the given variables in a readable format using `var_dump`, then 
 * terminates the script execution.
 *
 * @param mixed ...$args One or more variables to dump.
 */
function dd(...$args)
{
    echo '<pre style="font-size: 1.2em; background-color: black; color: white; padding: 15px">';
    var_dump(...$args);
    echo '</pre>';
    die();
}


function abort(int $code, string $message = '')
{
    http_response_code($code);
    render_view('error', ['code' => $code, 'message' => $message], 'Error ' . $code);
    die();
}


/**
 * Retrieves a configuration value from the CONFIG array.
 *
 * This function accesses the CONFIG array using the specified type and title
 * to retrieve a configuration value. If the value is not found, the provided
 * default value is returned.
 *
 * @param string $type The category or section of the configuration.
 * @param string $title The specific configuration key within the category.
 * @param string|null $default The default value to return if the configuration
 *                             value is not found. Defaults to null.
 * 
 * @return mixed The configuration value or the default value if not found.
 */
function get_config(string $type, string $title, string $default = null)
{
    return CONFIG[$type][$title] ?? $default;
}



/**
 * Validates user input by checking if all required fields are not empty.
 *
 * This function takes an associative array of inputs, and an array of required
 * field names. It then checks if all the required fields are present in the
 * inputs array and are not empty. If any required field is empty, the function
 * will return false. Otherwise, it will return true.
 *
 * @param array $inputs The associative array of inputs to validate.
 * @param array $required The array of required field names.
 *
 * @return bool True if all required fields are not empty, false otherwise.
 */
function validate_input(array $inputs, array $required)
{
    foreach ($inputs as $key => $value) {
        if (in_array($key, $required) && empty($value)) {
            return false;
        }
    }
    return true;
}



/**
 * Validates user documents through inputs and rules.
 * 
 * @param array $documents The documents to validate.
 * @param array $rules The rules to validate the documents against.
 * 
 * The rules array will contain the key of the document on the docuements array and
 * then the rule followed by its value, for example:
 * [
 *      'user_picture' => [
 *          'required' => true,
 *          'type' => 'image',
 *          'size' => '2mb',
 *          'mimetype' => 'image/jpeg'
 *      ],
 * ]
 */
function validate_documents(array $documents, array $rules)
{
    // for each document



    $documentNameBag = [];

    foreach ($documents as $key => $document) {

        if (in_array($document['name'], $documentNameBag)) {
            return ['result' => false, 'message' => 'Debes subir un documento diferente para ' . $key];
        }

        $rules = isset($rules[$key]) ? $rules[$key] : [];

        if (empty($rules)) {
            continue;
        }

        if(!$rules['required']) {
            continue;
        }

        

        if ($rules['required'] && empty($document['name'])) {
            return ['result' => DOCUMENTS_NOT_VALID, 'message' => 'El documento ' . $key . ' es obligatorio '];
        }

        if ($rules['type'] && $document['type'] != $rules['type']) {
            return ['result' => DOCUMENTS_NOT_VALID, 'message' => 'El documento ' . $document['name'] . ' debe ser de tipo ' . $rules['type']];
        }

        $sizeToMB = $rules['size'] / 1024 / 1024 . 'MB';

        if ($rules['size'] && $document['size'] > $rules['size']) {
            return ['result' => DOCUMENTS_NOT_VALID, 'message' => 'El documento ' . $key . ' debe ser menor a ' . $sizeToMB];
        }

        $documentNameBag[] = $document['name'];
    }
    // if all documents have passed all the rules, return true

    if(empty($documentNameBag)) {
        return ['result' => DOCUMENTS_OK, 'message' => 'Hay documentos sin subir'];
    }

    return ['result' => DOCUMENTS_VALID, 'message' => 'Documentos validados correctamente'];
}

<?php
define('ASSETS_FOLDER_ABSOLUTE', __DIR__ . '/resources/assets/');
define('ASSETS_FOLDER', '/resources/assets/');


define('WEB_RESOURCES_FOLDER', '/resources/views/');

/**
 * This is the helpers file, it will define some helper functions that need to be 
 * used on the entire website. Only define here GLOBAL functions.
*/


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
function asset(string $subdirectory, bool $relative = true,  bool $windows_path = false): string {

    // if the subdirectory starts with a slash
    if (substr($subdirectory, 0,1) === '/') {
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
function web_resource(string $subdirectory): string {

    // if the subdirectory starts with a slash
    if (substr($subdirectory, 0,1) === '/') {
        // The ASSETS_FOLDER already contains the trailing slash (preventing assets//img...)
        $subdirectory = substr($subdirectory, 1);
    }

    $final_path = WEB_RESOURCES_FOLDER . $subdirectory;
  

    return $final_path;
}
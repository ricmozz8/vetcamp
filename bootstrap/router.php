<?php



/**
 * Serves a view file.
 *
 * @param string $view The name of the view to serve. The .php extension
 *                     should be omitted.
 * @param array $data An associative array of variables to extract into the
 *                    view file's scope.
 */
function render_view(string $view, array $data = []): void {
    // serves the view file
    extract($data);
    require VIEWS_DIR . $view . '.php';
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
function redirect(string $url) {
    header('Location: ' . $url);
    exit;
}
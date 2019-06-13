<?php 
header("Content-Type: application/json");
//ini_set('display_errors', 1);
if (PHP_SAPI == 'cli-server') {
    // To help the built-in PHP dev server, check if the request was actually for
    // something which should probably be served as a static file
    $url  = parse_url($_SERVER['REQUEST_URI']);
    $file = __DIR__ . $url['path'];
    if (is_file($file)) {
        return false;
    }
}
//display the error
error_reporting(E_ALL);
set_error_handler(function ($severity, $message, $file, $line) {
    if (error_reporting() & $severity) {
        throw new \ErrorException($message, 0, $severity, $file, $line);
    }
});

require __DIR__ . '/../vendor/autoload.php';

session_start();

require __DIR__ . '/../app/models/config.php';
$app = new \Slim\App($config);


require __DIR__ . '/../app/models/dependencies.php';
require __DIR__ . '/../app/models/middleware.php';
require __DIR__ . '/../app/models/routes.php';
$app->run();
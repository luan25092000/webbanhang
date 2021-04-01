<?php
// Autoload class trong PHP
spl_autoload_register(function ($class_name) {
    $filename = __DIR__ . '/' . $class_name . '.php';
    $filename = str_replace('\\', '/', $filename);
    if (file_exists($filename)) {
        include_once $filename;
    }
});

// Create router instance
$router = new route\Router();

// Get current url. Default is "/"
$request_url = !empty($_GET['url']) ? '/'.$_GET['url'] : '/';

// Get current method (GET|POST). Default is "GET"
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

$request_url_2 = $_SERVER['REQUEST_URI'];

// Map URL
$router->map($request_url_2, $method_url);
?>
<?php
// Autoload class trong PHP
spl_autoload_register(function (string $class_name) {
    include_once $class_name.'.php';
});

// Create router instance
$router = new route\Router();

// Get current url. Default is "/"
$request_url = !empty($_GET['url']) ? '/'.$_GET['url'] : '/';

// Get current method (GET|POST). Default is "GET"
$method_url = !empty($_SERVER['REQUEST_METHOD']) ? $_SERVER['REQUEST_METHOD'] : 'GET';

// Map URL
$router->map($request_url, $method_url);
?>
<?php

// Get the requested URL
$request_uri = $_SERVER['REQUEST_URI'];

// Remove query string and trim leading/trailing slashes
$cleaned_uri = explode('?', $request_uri)[0];
$cleaned_uri = trim($cleaned_uri, '/');

// Split the URL into an array of segments
$segments = explode('/', $cleaned_uri);

// Define the base path for your application
$base_path = __DIR__;

// Set the default controller and action
$controller = 'home';
$action = 'index';

// Check if a controller is specified in the URL
if (!empty($segments[0])) {
    $controller = $segments[0];
}

// Check if an action is specified in the URL
if (!empty($segments[1])) {
    $action = $segments[1];
}

// Include the appropriate controller file based on the URL
$controller_path = "{$base_path}/pages/{$controller}/{$action}.php";

if (file_exists($controller_path)) {
    include($controller_path);
} else {
    // Handle 404 error if the controller file doesn't exist
    header("HTTP/1.0 404 Not Found");
    echo '404 Not Found';
}

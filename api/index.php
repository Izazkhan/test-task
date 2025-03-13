<?php

// Include the router file to handle route matching and dispatching
require 'routes.php';
require 'helpers.php';
// Set the response header to application/json
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: http://cc.localhost");
// Capture the request method and URI
$method = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];



// Dispatch the request to the appropriate route
dispatch($method, $uri);
?>

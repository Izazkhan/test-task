<?php
// router.php

// Function to register a route
function route($method, $pattern, $handler) {
    global $routes;
    $routes[$method][$pattern] = $handler;
}

function dispatch($method, $uri) {
    global $routes;

    // Clean the URI (remove query string and base path if needed)
    $uri = parse_url($uri, PHP_URL_PATH);
    $uri = trim($uri, '/');

    if (isset($routes[$method])) {
        foreach ($routes[$method] as $pattern => $handler) {
            // Convert pattern to regex
            $regex = preg_replace('#\{([a-zA-Z0-9_]+)\}#', '([a-zA-Z0-9_-]+)', $pattern);
            $regex = "#^" . trim($regex, '/') . "$#";

            // Match the URL against the route regex
            if (preg_match($regex, $uri, $matches)) {
                // Extract parameters (skip the full match at index 0)
                $params = array_slice($matches, 1);

                // Call the appropriate controller and method
                list($controller, $method) = explode('@', $handler);

                // Check if the controller exists
                if (class_exists($controller)) {
                    $controllerInstance = new $controller();
                    
                    // Check if the method exists
                    if (method_exists($controllerInstance, $method)) {
                        // Call the method with parameters
                        call_user_func_array([$controllerInstance, $method], $params);
                    } else {
                        // Method not found in controller
                        http_response_code(500);
                        echo json_encode(['error' => 'Method not found']);
                    }
                } else {
                    // Controller not found
                    http_response_code(500);
                    echo json_encode(['error' => 'Controller not found']);
                }
                return;
            }
        }
    }

    // If no route was matched
    http_response_code(404);
    echo json_encode(['error' => 'Route not found']);
}


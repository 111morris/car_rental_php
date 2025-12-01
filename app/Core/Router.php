<?php

namespace App\Core;

class Router
{
    protected $routes = [];

    public function get($path, $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve()
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // Remove project folder from path if running in subdirectory
        // Assuming /car-rental-php/public/ is the root, we might need to adjust.
        // For now, let's assume the server root points to public/ or we handle relative paths.
        // A robust way is to strip the script name directory.
        
        $scriptName = dirname($_SERVER['SCRIPT_NAME']);
        if ($scriptName !== '/' && strpos($path, $scriptName) === 0) {
            $path = substr($path, strlen($scriptName));
        }
        if ($path === '') {
            $path = '/';
        }

        $method = $_SERVER['REQUEST_METHOD'];
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            http_response_code(404);
            echo "404 Not Found";
            return;
        }

        if (is_array($callback)) {
            $controller = new $callback[0]();
            $action = $callback[1];
            call_user_func([$controller, $action]);
        } else {
            call_user_func($callback);
        }
    }
}

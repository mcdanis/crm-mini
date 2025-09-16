<?php

class Router
{
    private $routes = [];

    public function get($pattern, $callback)
    {
        $this->routes['GET'][$pattern] = $callback;
    }

    public function post($pattern, $callback)
    {
        $this->routes['POST'][$pattern] = $callback;
    }

    public function dispatch($uri, $method)
    {
        $uri = trim($uri, '/');
        if ($uri === '') {
            $uri = '';
        }
    
        if (!isset($this->routes[$method])) {
            http_response_code(405);
            echo "Method Not Allowed";
            return;
        }
    
        foreach ($this->routes[$method] as $pattern => $callback) {
            $patternRegex = preg_replace('#\{(\w+)\}#', '(\w+)', $pattern);
    
            if (preg_match('#^' . $patternRegex . '$#', $uri, $matches)) {
                array_shift($matches); // hapus full match
    
                // kalau callback string "Controller@method"
                if (is_string($callback) && strpos($callback, '@') !== false) {
                    list($controller, $methodName) = explode('@', $callback);
    
                    $controllerClass = "App\\Controllers\\$controller";
                    $controllerInstance = new $controllerClass();
    
                    return call_user_func_array([$controllerInstance, $methodName], $matches);
                }
    
                // kalau callback closure
                return call_user_func_array($callback, $matches);
            }
        }
    
        http_response_code(404);
        echo "404 Not Found";
    }
    
}

<?php
class Router
{
    private $defaultPath;
    private $routes = [];

    public function __construct($defaultPath)
    {
        if ($defaultPath === '/')
            $this->defaultPath = '';
        else
            $this->defaultPath = $defaultPath;
    }

    public function addRoute($method, $pathPattern, $callback)
    {
        $path = $this->defaultPath .  $pathPattern;
        $this->routes[] = [
            'method' => $method,
            'pathPattern' => $pathPattern,
            'path' => $path,
            'callback' => $callback
        ];
    }

    public function handleRequest($method, $path)
    {
        foreach ($this->routes as $route) {
            if ($route['method'] === $method) {
                $pattern = $this->getPatternFromPath($route['pathPattern']);
                if (preg_match($pattern, $path, $matches)) {
                    array_shift($matches); // Remove the full match
                    $callback = $route['callback'];
                    if (is_callable($callback)) {
                        call_user_func($callback, $matches);
                        return;
                    }
                }
            }
        }
        // If no matching route is found, return a 404 response
        http_response_code(404);
        echo "404 Not Found";
    }

    private function getPatternFromPath($pathPattern)
    {
        $pattern = preg_replace('/\//', '\\/', $pathPattern);
        $pattern = preg_replace('/\{([^\/]+)\}/', '(?P<$1>[^\/]+)', $pattern);
        $pattern = '/^' . $pattern . '$/';
        return $pattern;
    }
}
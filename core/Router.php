<?php

namespace Core;

class Router
{
    public Request $request;
    private array $routes = [];
    private array $params = [];

    public function any(string $path, callable $callback): void
    {
        $this->get($path, $callback);
        $this->post($path, $callback);
    }

    public function get(string $path, callable $callback): void
    {
        $this->routes['GET'][$path] = $callback;
    }

    public function post(string $path, callable $callback): void
    {
        $this->routes['POST'][$path] = $callback;
    }

    public function resolve(Request $request): array
    {
        $matches = [];
        $uri = $request->getUri() ;
        $method = $request->method();

        foreach ($this->routes[$method] as $key => $value) {
            if (preg_match($key,$uri,$matches) != 1){
                continue;
            }

            $path = $key;

            if (count($matches) > 1){
                \array_shift($matches);
                $this->params = $matches;
            }
            return [$this->routes[$method][$path] ?? null,$this->params] ;

        }

        return [null, null];

    }
}
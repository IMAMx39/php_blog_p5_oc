<?php

namespace Core;

use LogicException;
use Whoops\Handler\PrettyPageHandler;
use Whoops\Run;

class Application
{
    private Router $router;

    public function __construct()
    {
        Parameter::init(dirname(__DIR__).'/config/parameter.php');
        if (Parameter::get('app_env') === 'dev') {
            $whoops = new Run;
            $whoops->pushHandler(new PrettyPageHandler);
            $whoops->register();
            //error_reporting(E_ALL);
            //ini_set('display_errors', 1);
        }

        $this->router = new Router();
    }

    public function request(Request $request): Response
    {
        [$callable, $params] = $this->router->resolve($request);
        if (!is_callable($callable)) {
            return new Response('', 404);
        }

        $response = call_user_func_array($callable, [$request,$params]);
        if (!$response instanceof Response) {
            throw new LogicException('Controller response must be an instance of ' . Response::class . ' ' . gettype($response) . ' given');
        }

        return $response;
    }

    public function getRouter(): Router
    {
        return $this->router;
    }
}

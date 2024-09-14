<?php

require __DIR__ . '/vendor/autoload.php';

use MiniRoute\Route;
use MiniRoute\Router;
use MiniRoute\Application;
use MiniRoute\Request;
use MiniRoute\Response;

echo "<pre>";

class ValidationMiddleware
{
    public function handle(Request $request, $next)
    {
        if (!empty($request->getData()['name'])) {
            return 'Ошибка: поле "name" обязательно для заполнения.';
        }
        return $next($request);
    }
}

$routers = new Router();

$router = $routers->addRoutes([
    (new Route('home_page', '/', ['MiniRoute\\Controller\\Home1'])),
    new Route('home_page', '/sdf', ['MiniRoute\\Controller\\Home2']),
    (new Route('api_articles', '/view/article/{id}/{name}/', ['MiniRoute\\Controller\\ArticleController', 'getAll'], ['GET'])),
]);

try {
    $route = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

    print_r($route);

    $controller = new ($route->getController())();
    $methodName = $route->getAction();

    if (!is_callable($controller)) {
        $controller = [$controller, $methodName];
    }

    $app = new Application($controller, $route->getMiddlewares());
    $body = $app->handle(new Request($route->getMethods(), $route->getAttributes()));

    $response = new Response(200, $body);
    $response->send();
} catch (\Exception $exception) {
    header("HTTP/1.0 404 Not Found");
}

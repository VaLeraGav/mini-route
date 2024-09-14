# mini-route

Mini-router is a project using the Psr and middleware. This project was designed to refresh your memory, and requires deep improvements.

```php
class ArticleController
{
    public function getAll(Request $request)
    {
        // TODO: in a good way, you need to return a Response
        return json_encode([
            ['id' => 1],
        ]);
    }
}

class ValidationMiddleware implements MiddlewareInterface
{
    public function process(Request $request, callable $next)
    {
        if (!empty($request->getData()['name'])) {
            return 'Ошибка: поле "name" обязательно для заполнения.';
        }
        return $next($request);
    }
}

$routers = new Router();

$router = $routers->addRoutes([
    (new Route('home_page', '/', ['MiniRoute\\Controller\\Home1']))->add(new ValidationMiddleware()),
    new Route('home_page', '/sdf', ['MiniRoute\\Controller\\Home2']),
    (new Route('api_articles', '/view/article/{id}/{name}/', ['MiniRoute\\Controller\\ArticleController', 'getAll'], ['GET'])),
]);

try {
    $route = $router->matchFromPath($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);

    $controller = new ($route->getController())();
    $methodName = $route->getAction();

    $callbackController = [$controller, $methodName];

    $app = new Application($callbackController, $route->getMiddlewares());
    $body = $app->handle(new Request($route->getMethods(), $route->getAttributes()));

    $response = new Response(200, $body);
    $response->send();
} catch (\Exception $exception) {
    header('HTTP/1.0 404 Not Found');
}
```

<?php

declare(strict_types=1);

namespace MiniRoute;

class Pipeline
{
    private $middlewares = [];
    private $handler;

    public function __construct(callable $handler, array $middlewares)
    {
        $this->handler = $handler;
        $this->middlewares = $middlewares;
    }

    /**
     * Go through the entire middleware and complete them
     *
     * @param Request $request Request for routing
     */
    public function handle(Request $request)
    {
        $next = $this->handler;

        foreach (array_reverse($this->middlewares) as $middleware) {
            $next = function ($request) use ($middleware, $next) {
                return $middleware->process($request, $next);
            };
        }

        return $next($request);
    }
}

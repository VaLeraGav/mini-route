<?php

declare(strict_types=1);

namespace MiniRoute;

class Application
{
    /**
     * @param array<Middleware> $middlewares
     */
    public function __construct(
        private $handler,
        private readonly array $middlewares,
    ) {
    }

    /**
     *  Launch the application, launch the Pipeline
     *
     * @param mixed $middlewares
     */
    public function handle(Request $request)
    {
        return (new Pipeline($this->handler, $this->middlewares))->handle($request);
    }
}

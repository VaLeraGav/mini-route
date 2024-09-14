<?php

declare(strict_types=1);

namespace MiniRoute;

interface MiddlewareInterface
{
    /**
     * @param callable(Request): Response $next
     */
    public function process(Request $request, callable $next);
}

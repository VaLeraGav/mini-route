<?php

declare(strict_types=1);

namespace MiniRoute;

final class Response
{
    public function __construct(
        public readonly int $statusCode = 200,
        public readonly string $body = '',
        public readonly array $headers = []
    ) {}

    public function setStatusCode(int $code): void
    {
        $this->statusCode = $code;
    }

    public function setBody($body): void
    {
        $this->body = $body;
    }

    public function setHeader($name, $value): void
    {
        $this->headers[$name] = $value;
    }

    public function send(): void
    {
        http_response_code($this->statusCode);
        foreach ($this->headers as $name => $value) {
            header("$name: $value");
        }
        echo $this->body;
    }
}

<?php

declare(strict_types=1);

namespace MiniRoute;

final class Request
{
    private const GET = 'GET';
    private const POST = 'POST';

    public function __construct(
        public readonly array $method,
        public readonly array $attributes,
        public array $data = [],
        public readonly array $headers = []
    ) {
        if (!$this->data) {
            $this->data = $this->setBody($this->method);
        }
    }

    public function getData()
    {
        return $this->data;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function getHeader($name)
    {
        return $this->headers[$name] ?? null;
    }

    private function setBody($method)
    {
        if (in_array(self::GET, $method)) {
            return $_GET;
        }
        if (in_array(self::POST, $method)) {
            return $_POST;
        }
        return $_REQUEST;
    }
}

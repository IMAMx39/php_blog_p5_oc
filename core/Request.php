<?php

namespace Core;

use InvalidArgumentException;

class Request
{
    public function getUri(): string
    {
        return $_SERVER['REQUEST_URI'] ?? '/';
    }

    public function isGET(): bool
    {
        return $this->method() === 'GET';
    }

    public function method(): string
    {

        return $_SERVER['REQUEST_METHOD'];

    }

    public function isPOST(): bool
    {
        return $this->method() === 'POST';
    }

    public function query(): array
    {
        return $_GET;
    }

    public function request(): array
    {
        return $_POST;
    }

    public function post(string $key): string
    {
        if (!array_key_exists($key, $this->request())) {
            throw new InvalidArgumentException($key . ' not exist');
        }
        return trim(htmlspecialchars($this->request()[$key]));
    }

    public function getOrNull(string $key): ?string
    {
        try {
            return $this->post($key);
        } catch (InvalidArgumentException $e) {
            return null;
        }
    }
}

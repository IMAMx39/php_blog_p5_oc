<?php

namespace Core;

final class Parameter
{
    private static Parameter $instance;
    private array $params;

    private function __construct(array $params)
    {
        $this->params = $params;
    }

    public static function init(string $path): void
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException(sprintf('%s does not exist', $path));
        }
        self::$instance = new self(require $path);
    }

    private static function getParameter(): self
    {
        if (self::$instance === null) {
            throw new \LogicException('Please call ::init() method before get ' . self::class);
        }
        return self::$instance;
    }


    public static function get(string $key)
    {
        if (!isset(self::getParameter()->params[$key])) {
            throw new \InvalidArgumentException($key.' not exists');
        }

        return self::getParameter()->params[$key];
    }
}
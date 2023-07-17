<?php

namespace Core\Form;

use Stringable;

final class Label implements Stringable
{
    private string $name;
    private ?string $for = null;

    public function __construct(string $name, array $attributes = [])
    {
        $this->name = $name;
        if (isset($attributes['for'])) {
            $this->for = $attributes['for'];
        }
    }

    public function __toString(): string
    {
        return $this->start() . $this->end();
    }

    public function start(): string
    {
        return sprintf('<label for="%s">%s', $this->for, $this->name);
    }

    public function end(): string
    {
        return '</label>';
    }
}
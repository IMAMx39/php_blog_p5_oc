<?php

namespace Core\Form;

use Core\Request;

class FormBuilder
{
    private array $fields = [];
    private string $method;
    private string $action;
    private ?Request $request = null;

    public function __construct(string $method = 'POST', string $action = '')
    {
        $this->method = $method;
        $this->action = $action;
    }

    public function add(Field $field): self
    {
        $this->fields[$field->getName()] = $field;
        return $this;
    }

    public function handleRequest(Request $request): FormBuilder
    {
        $this->request = $request;
        return $this;
    }

    public function isSubmitted(): bool
    {
        return $this->request?->isPOST() ?: false;
    }

    public function isValid(): bool
    {
        return true;
    }

    public function __toString(): string
    {
        return $this->start() . implode('', $this->fields) . $this->end();

    }

    public function start(): string
    {
        return sprintf('<form action="%s" method="%s" >', $this->action, $this->method);
    }

    public function end(): string
    {
        return '</form>';
    }

    public function row(string $name): string
    {
        if (!isset($this->fields[$name])) {
            throw new \InvalidArgumentException("{$name} field doesn't exist");
        }
        return $this->fields[$name];

    }
}

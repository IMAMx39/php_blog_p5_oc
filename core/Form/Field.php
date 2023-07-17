<?php

namespace Core\Form;

use Closure;
use Stringable;

abstract class Field implements Stringable
{
    protected string $name;
    protected ?Label $label = null;
    protected array $attributes;
    protected ?Closure $render = null;
    protected array $constraints;

    public function __construct(string $name, array $attributes = [], array $constraints = [])
    {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->constraints = $constraints;
    }

    public function withLabel(string $name, array $attributes = []): self
    {

        if (isset($this->attributes['id'])) {
            $attributes['for'] = $this->attributes['id'];
        }
        $this->label = new Label($name, $attributes);
        return $this;
    }

    public function render(Closure $render): self
    {
        $this->render = $render;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Label|null
     */
    public function getLabel(): ?Label
    {
        return $this->label;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    public function __toString(): string
    {
        if ($this->render instanceof \Closure) {
            $render = $this->render;
            return $render($this);
        }

        return $this->template();
    }

    abstract protected function template(): string;
//    abstract public function submit(Request $request): void;

}

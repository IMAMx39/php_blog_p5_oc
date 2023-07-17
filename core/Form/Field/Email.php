<?php

namespace Core\Form\Field;

use Core\Form\Field;

class Email extends Field
{

    private bool $required = false;


    protected function template(): string
    {
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = "{$key}={$value}";
        }
        return sprintf(
            '%s<input type="email" name="%s" %s %s>',
            $this->label,
            $this->name,
            implode(' ', $attributes), $this->required ? 'required' : '');
    }

    public function required(): self
    {
        $this->required = true;
        return $this;
    }
}

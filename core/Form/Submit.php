<?php

namespace Core\Form;

class Submit extends Field
{
    protected function template(): string
    {
        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = "{$key}={$value}";
        }

        return sprintf(
            '<button type="submit" %s>%s</button>',
            implode(' ', $attributes),
            $this->label
        );
    }
}

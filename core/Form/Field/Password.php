<?php

namespace Core\Form\Field;

use Core\Form\Field;

class Password extends Field
{

    private bool $required = false;



    protected function template(): string
    {

        $attributes = [];
        foreach ($this->attributes as $key => $value) {
            $attributes[] = "{$key}={$value}";
        }

        return sprintf(
            '%s<input type="password" name="%s" %s %s>',
            $this->label,
            $this->name,
            implode(' ', $attributes), $this->required ? 'required' : '');
    }

    //protected function template(): string
    //{
    //    $field = '<label for="' . $this->name . '">' . $this->label . '</label>' .
    //        '<input type="password" id="' . $this->name . '" name="' . $this->name . '"';
    //
    //    foreach ($this->attributes as $attribute => $value) {
    //        $field .= ' ' . $attribute . '="' . $value . '"';
    //    }
    //
    //    $field .= '>';
    //
    //    return $field;
    //}

    public function required(): self
    {
        $this->required = true;
        return $this;
    }
}
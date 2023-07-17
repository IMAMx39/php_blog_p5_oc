<?php

namespace Core;

final class Render
{
    public static function render(string $view, array $data): string
    {
        extract(array_merge($data, []));
        ob_start();
        include_once(Parameter::get('template_path').$view).'.php';
        return ob_get_clean();
    }
}

<?php

namespace Core;

use App\Service\UserService;

abstract class Controller
{
    private UserService $userService;


    public function __construct()
    {
        $this->userService = new UserService();
        //$this->render = $render;
    }

    protected function render(string $view, array $data): Response
    {
        $layout = $this->layoutContent();
        $view = Render::render($view, $data);
        return new Response(str_replace('{{ content }}', $view, $layout));

    }

    protected function renderHTML(string $view, array $data): string
    {
        $layout = $this->layoutContent();
        $view = Render::render($view, $data);
        return (str_replace('{{ content }}', $view,$layout));

    }

    private function layoutContent(): string
    {
        ob_start();
        $user =(new UserService())->getUserFromSession();
        include_once(Parameter::get('template_base'));
        return ob_get_clean();
    }


    public function redirectTo(string $uri) :string
    {
        header("Location: $uri");
        exit();
    }


}
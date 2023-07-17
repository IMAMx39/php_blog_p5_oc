<?php

namespace App\Controller;

use App\Service\UserService;
use Core\Controller;
use Core\Form\Field\Email;
use Core\Form\Field\Input;
use Core\Form\Field\Textarea;
use Core\Form\FormBuilder;
use Core\Request;
use Core\Response;


class HomeController extends Controller
{
    private UserService $userService;

    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function contact(Request $request): Response
    {

        $user = $this->userService->getUserFromSession();
        $form = (new FormBuilder())
            ->add(
                (new Input('username', ['id' => 'username', 'class' => 'form-control']))
                    ->withLabel('Nom et Prénom')
            )
            ->add(
                (new Email('email', ['id' => 'email', 'class' => 'form-control']))
                    ->withLabel('Email')
                    ->required()
            )
            ->add(
                (new Textarea('subject', ['id' => 'subject', 'class' => 'form-control']))
                    ->withLabel('Votre message')
                    ->required()
            );

        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {
            $username = $request->post('username');
            $email = $request->post('email');
            $subject = $request->post('subject');
        }

        return $this->render('home', [
            "form" => $form,
            "user" => $user
        ]);
    }
}
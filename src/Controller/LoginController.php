<?php

namespace App\Controller;

use App\Model\User;
use App\Repository\UserRepository;
use App\Service\UserService;
use Core\Controller;
use Core\Form\Field\Input;
use Core\Form\Field\Password;
use Core\Form\FormBuilder;
use Core\Request;
use Core\Response;

class LoginController extends Controller
{
    private UserRepository $userRepository;
    private UserService $userService;

    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->userService = new UserService();
    }

    public function login(Request $request): Response
    {
        $form = new FormBuilder('POST', '/login');

        $form
            ->add(
                (new Input('email',['id' => 'email', 'class' => 'form-control']))
                    ->withLabel('Email')
                    ->required()
            )->add(
                (new Password('password', ['id' => 'password', 'class' => 'form-control']))
                    ->withLabel('Mot de passe')
                    ->required()
            );

        $errors = [];
        if ($form->handleRequest($request)->isSubmitted() && $form->isValid()) {

            $email = $request->post('email');
            $password = $request->post('password');

            $user = $this->userRepository->getUser($email);
            if ($user->getStatus()==='banned'){

                return $this->showError("Ce compte a été banni par un administrateur.");
            }

            if ($user instanceof User && UserService::verifyPassword($password, $user->getPassword())) {
                $this->userService->login($user);
                header('location: /home');
                exit();
            }
            return $this->showError("Mauvais identifiant ou mot de passe.");
        }

        return $this->render('login', [
            "form" => $form,
            "errors" => $errors,
        ]);
    }

    private function showError(string $errors): Response
    {
        $data['errors'] = $errors;
        return $this->render('error', $data);
    }

}
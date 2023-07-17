<?php

namespace App\Controller;

use App\Service\UserService;
use Core\Controller;
use Core\Request;
use Core\Response;
use Core\Session;

class LogoutController extends Controller
{
    private UserService $userService;
    public function __construct()
    {
        $this->userService = new UserService();
    }

    public function logout(): Response
    {
        Session::Destroy();
        return $this->redirectTo('/');
    }


}
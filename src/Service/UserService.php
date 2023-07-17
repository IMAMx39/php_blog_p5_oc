<?php

namespace App\Service;

use App\Model\User;
use App\Repository\UserRepository;
use Core\Session;

final class UserService
{
    private Session $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public static function verifyPassword(string $plainPassword, string $hash): bool
    {
        return password_verify($plainPassword, $hash);
    }

    public function getUserFromSession(): ?User
    {
        $user = $this->session->get('user');
        if (!$user instanceof User){
            return null;
        }
        return $user;
    }

    public function register(User $user, string $plainPassword): void
    {
        $userRepository = new UserRepository();
        if ($userRepository->register($user, self::hashPassword($plainPassword))) {
            $this->login($user);
        }
    }

    public static function hashPassword(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_BCRYPT, ['cost' => 12]);
    }

    public function login(User $user): void
    {
        $this->session->set('user', $user);
    }
}

<?php

namespace App\Repository;

use App\Model\User;
use Core\Db\Manager;
use PDO;

class UserRepository extends Manager
{


    public function getAllUsers(): array
    {

        $query = $this->getCnxConfig()->prepare(
            'SELECT pseudo,email, fk_user_status as status,firstname,lastname FROM user
                    where fk_user_status = "visitor" or fk_user_status = "banned" order by pseudo'
        );
        $query->setFetchMode(PDO::FETCH_CLASS, User::class);

        $query->execute();
        $result = $query->fetchAll();
        return !$result ? [] : $result;
    }

    public function register(User $user, string $hashedPassword): bool
    {
        $status = 'visitor';

        $req = $this->getCnxConfig()->prepare(
            'INSERT INTO user (pseudo,email, password, fk_user_status, firstname, lastname)
            VALUES (?, ?, ?, ?, ?, ?)');

        return $req->execute([
            $user->getPseudo(),
            $user->getEmail(),
            $hashedPassword,
            $status,
            $user->getFirstname(),
            $user->getLastname()
        ]);
    }

    public function getUser(string $email): ?User
    {

        $query = $this->getCnxConfig()->prepare(
            'SELECT password, email, pseudo, firstname, lastname, fk_user_status as status   FROM user 
                WHERE email = ?');

        $query->setFetchMode(PDO::FETCH_CLASS, User::class);

        if (!$query->execute([($email)])) {
            return null;
        }

        $result = $query->fetch();
        return !$result ? null : $result;
    }

    public function banUser(string $name) : bool
    {
        $req = $this->getCnxConfig()->prepare(
            'UPDATE user SET fk_user_status = "banned" WHERE pseudo = ?'
        );

        return $req->execute([$name]);
    }

    public function unbanUser(string $name) : bool
    {
        $req = $this->getCnxConfig()->prepare(
            'UPDATE user SET fk_user_status = "visitor" WHERE pseudo = ?'
        );

        return $req->execute([$name]);
    }
}

<?php

namespace App\Repository;

use App\Model\Comment;
use Core\Db\Manager;

class CommentRepository extends Manager
{

    public function find(int $postId) : array
    {
        $req = $this->getCnxConfig()->prepare(
            'SELECT c.id, c.content, c.createdAt , c.fk_comment_status status,
                        u.pseudo author
                FROM comment c, user u
                WHERE c.fk_user_pseudo = u.pseudo AND c.fk_post_id = ?
                ORDER BY createdAt DESC');

        $req->setFetchMode(\PDO::FETCH_CLASS, Comment::class);
        $req->execute([$postId]);

        return $req->fetchAll();
    }

    public function add(int $postId, string $comment, string $username, bool $isAdmin) : bool
    {
        $status = $isAdmin ? 'approved' : 'not_approved';
        $req = $this->getCnxConfig()->prepare(
            'INSERT INTO comment (fk_post_id, fk_user_pseudo, fk_comment_status, content, createdAt)
                VALUES (?, ?, ?, ?, now() )');

        return $req->execute([$postId, $username, $status, $comment]);
    }

    public function delete(int $id): bool
    {
        $query = $this->getCnxConfig()->prepare('delete from comment where id =?');
        $result = $query->execute([$id]);

        return $result && $query->rowCount() > 0;
    }

    public function approve(int $commentId) : bool
    {
        $req = $this->getCnxConfig()->prepare(
            'UPDATE comment SET fk_comment_status = "approved" WHERE id = ?');

        $rslt = $req->execute(array($commentId));

        return $rslt && $req->rowCount() > 0;
    }

}

<?php

namespace App\Repository;

use App\Model\Post;
use Core\Db\Manager;
use Core\QueryBuilder\Insert;

class PostRepository extends Manager
{

    public function createPost(Post $post,string $username) : ?int
    {
        $query = $this->getCnxConfig()->prepare(
            //(new Insert('post', ['title' => '?', 'head'=>'?', 'content'=>'?', 'createdAt'=> new \DateTime()->formatd(), 'fk_user_pseudo'=>'?']))
            'INSERT INTO post(title,head,content, createdAt, fk_user_pseudo) VALUES (?, ?, ?, now(), ?);'
        );

        $result = $query->execute([
            $post->getTitle(),
            $post->getHead(),
            $post->getContent(),
            $username
        ]);

        return $result ? $this->getCnxConfig()->lastInsertId() : null;

    }

    public function getAllPosts() : array
    {
        $req = $this->getCnxConfig()->query(
            'SELECT id, title, head, content,createdAt , updatedAt ,  pseudo author
                FROM post  INNER JOIN user on post.fk_user_pseudo = user.pseudo ORDER BY post.createdAt DESC');

        $req->execute();

        return $req->fetchAll(\PDO::FETCH_CLASS,Post::class);
    }

    public function getPostByID(int $id) : ?Post
    {
        if(!$id) {
            return null;
        }
        $req = $this->getCnxConfig()->prepare(
            'SELECT id, title, head, content, createdAt , updatedAt , pseudo author FROM post, user 
                WHERE post.fk_user_pseudo = user.pseudo AND post.id = ?');

        $req->setFetchMode(\PDO::FETCH_CLASS, Post::class);
        $req->execute([($id)]);
        return $req->fetch();
    }

    public function updatePost(Post $post) : bool
    {
        $req = $this->getCnxConfig()->prepare(
            'UPDATE post  SET title = ?, head = ?, content = ?, updatedAt = now()  WHERE id = ?');

        return $req->execute([
            $post->getTitle(),
            $post->getHead(),
            $post->getContent(),
            $post->getId()]);
    }

    public function deletePost(int $postId) : bool
    {
        $req = $this->getCnxConfig()->prepare('DELETE FROM post WHERE id = ?');

        return $req->execute([($postId)]);
    }

}